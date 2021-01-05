<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Faq;
use Yajra\Datatables\Datatables;

use Response;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.add');
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
                                        'question'       => 'required',
                                        'answer'         => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{
            
            $faq = new Faq; 
            $faq->question = $request->get('question');
            $faq->answer   = $request->get('answer');
            $faq->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Faq added successfully');
            return redirect()->back();


        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        
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
        $faq = Faq::find($id);
        return view('admin.faq.edit')->with('faq', $faq);
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
                                        'question'       => 'required',
                                        'answer'         => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{
            
            $faq = Faq::find($id); 
            $faq->question = $request->get('question');
            $faq->answer   = $request->get('answer');
            $faq->update();

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Faq Updated successfully');
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
            $faq = Faq::findOrFail($id);
            $faq->delete();
           
            if($faq){
                return Response::json(['success' => true, 'status' => 1, 'message' => "Faq has been deleted successfully."]);
            }else{
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        }catch(\Exception $e){
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        } 
    }

    public function getFaqs(Request $request){
         $allFaqs = Faq::orderBy('created_at','desc')->get();
       
        return DataTables::of($allFaqs)
            ->addColumn('question',function($allFaqs) {
                return $allFaqs->question;
            })    
            ->addColumn('answer',function($allFaqs) {
               
                return  $allFaqs->answer;
            })    
            ->editColumn('created_at',function($allFaqs) {
                if(!empty($allFaqs->created_at)) {
                    return getDateOnly($allFaqs->created_at);
                }
                return 'N/A';
            })
           ->addColumn('action',function($allFaqs) {
                $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="'.route('faqs.edit', $allFaqs->id ).'"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Faq</a>';

                
                $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteFaq(this,'.$allFaqs->id.')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Faq</a>';
                $str .= '</div></div>';
                return $str;
            }) 
            ->rawColumns(['question','answer','created_at', 'action'])
            ->make(true);         

    }
}
