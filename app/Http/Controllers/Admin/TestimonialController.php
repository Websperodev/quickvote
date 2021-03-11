<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use App\Models\Testimonial;
use Yajra\Datatables\Datatables;

use Response;


class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    
    public function index()
    {
        return view('admin.testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
                                        'name'          => 'required',
                                        'image'         => 'required',
                                        'description' => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{
            
            $testimonial = new Testimonial; 
            $testimonial->name = $request->get('name');
            $testimonial->description   = $request->get('description');
            $testimonial->save();

            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $validated = $request->validate([
                        'image' => 'string|max:40',
                        'image' => 'mimes:jpeg,png|max:1014',
                    ]);
                    $file = request()->file('image');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $testimonial->img =  $img;
                    $testimonial->update();
                }
            }
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Testimonial added successfully');
            return redirect()->back();


        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        
    }

    public function getTestimonial(Request $request){
         $allTestimonial = Testimonial::orderBy('created_at','desc')->get();
       
        return DataTables::of($allTestimonial)
            ->addColumn('name',function($allTestimonial) {
                return $allTestimonial->name;
            })    
            ->addColumn('image',function($allTestimonial) {
                $img = '-';
                if($allTestimonial->img != ''){
                    $img = '<img src="'. url($allTestimonial->img) .'" width="100" height="100">';
                }
                
                return $img;
            })    
            ->editColumn('created_at',function($allTestimonial) {
                if(!empty($allTestimonial->created_at)) {
                    return getDateOnly($allTestimonial->created_at);
                }
                return 'N/A';
            })
           ->addColumn('action',function($allTestimonial) {
                $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="'.route('testimonials.edit', $allTestimonial->id ).'"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Testimonial</a>';

                
                $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteTestimonial(this,'.$allTestimonial->id.')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Testimonial</a>';
                $str .= '</div></div>';
                return $str;
            }) 
            ->rawColumns(['name','image','created_at', 'action'])
            ->make(true);         

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('admin.testimonial.edit')->with('testimonial', $testimonial);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                                        'name'          => 'required',
                                        'description'   => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{
            
            $testimonial = Testimonial::find($id); 
            $testimonial->name = $request->get('name');
            $testimonial->description   = $request->get('description');
            $testimonial->update();

            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $validated = $request->validate([
                        'image' => 'string|max:40',
                        'image' => 'mimes:jpeg,png|max:1014',
                    ]);
                    if(file_exists(public_path($request->get('existing_img')))){
                        unlink(public_path($request->get('existing_img')));
                        File::delete(public_path($request->get('existing_img')));
                    }
                    $file = request()->file('image');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $testimonial->img =  $img;
                    $testimonial->update();
                }
            }
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Testimonial Updated successfully');
            return redirect()->back();


        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        try{
            $testimonial = Testimonial::findOrFail($id);
            if($testimonial->img != '' && file_exists(public_path($testimonial->img))){
                unlink(public_path($testimonial->img));
                File::delete(public_path($testimonial->img));
            }
            $testimonial->delete();
           
            if($testimonial){
                return Response::json(['success' => true, 'status' => 1, 'message' => "Testimonial has been deleted successfully."]);
            }else{
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        }catch(\Exception $e){
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        } 
    }
}
