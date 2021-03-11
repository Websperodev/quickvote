<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use App\Models\Service;

class ServicesController extends Controller
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
    
    public function index(Request $request)
    { 
        $services = [];
        $service_type = $request->get('type');
        $services = Service::where('type', $service_type)->get();
        
        return view('admin.services.add', compact('services' , 'service_type'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                                        "name"           => "required",
                                        "name.*"         => "required",
                                        "description"    => "required",
                                        "description.*"  => "required",
                                        "image"          => "required",
                                        "image.*"        => "required",
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }

        try{

            $name = $request->get('name');
            $description = $request->get('description');
            $files = $request->file('image');
            $existing_id = $request->get('existing_id');
            $existing_img = $request->get('existing_img');
            
            if(!empty($existing_id)){
                foreach($name as $k => $val){
                    $img = '';
                    if($request->hasFile('image'))
                    {   
                        if(isset($files[$k])){
                            if(file_exists(public_path($existing_img[$k]))){
                                unlink(public_path($existing_img[$k]));
                                File::delete(public_path($existing_img[$k]));
                            }
                            $file = $files[$k];
                            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                            $file->move('./uploads/images/', $fileName); 
                            $img = '/uploads/images/'.$fileName;      
                        }  
                    }

                    $service_id      = $existing_id[$k];
                    $service         = Service::find($service_id); 
                    $service->name   = $val;
                    $service->text   = $description[$k];
                    $service->type   = $request->get('type');
                    $service->image  =  $img;
                    $service->update();
                }
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Services added successfully');
                return redirect()->back();
            }else{
             
                foreach($name as $k => $val){
                    $img = '';
                    if($request->hasFile('image'))
                    {   
                        $file = $files[$k];
                        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                        $file->move('./uploads/images/', $fileName); 
                        $img = '/uploads/images/'.$fileName;      
                    }

                    $service         = new Service; 
                    $service->name   = $val;
                    $service->text   = $description[$k];
                    $service->type   = $request->get('type');
                    $service->image  =  $img;
                    $service->save(); 
                }
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Services added successfully');
                return redirect()->back();
            }


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
