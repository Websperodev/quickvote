<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use App\Models\Faq;
use App\Models\Page;
use App\Models\TeamMember;
use Yajra\Datatables\Datatables;

use Response;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.team.index');
    }
    public function getPageData(){
        $teamData = Page::where('page_name','our-team')->get();
        return view('admin.team.add-page', compact('teamData'));  
    }

    public function openInvestors(){
        $invstorData = Page::where('page_name','our-investors')->get();
        return view('admin.team.investor-page', compact('invstorData'));  

    }
    public function addInvestorData(Request $request){
        $validator = Validator::make($request->all(), [
                                        'heading'      => 'required',
                                        'description'  => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{
            $page = Page::where('page_name','our-investors')->count();
            if($page > 0){
                Page::where('page_name','our-investors')->delete();
            }
            $page = new Page; 
            $page->page_name = 'our-investors';
            $page->section   = 'our-investors';
            $page->heading1  = $request->get('heading');
            $page->description   = $request->get('description');
            $page->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Data submitted successfully');
            return redirect()->back();

        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function addPageData(Request $request){
        $validator = Validator::make($request->all(), [
                                        'heading'      => 'required',
                                        'description'  => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{
            $page = Page::where('page_name','our-team')->count();
            if($page > 0){
                Page::where('page_name','our-team')->delete();
            }
            $page = new Page; 
            $page->page_name = 'our-team';
            $page->section   = 'our-team';
            $page->heading1  = $request->get('heading');
            $page->description   = $request->get('description');
            $page->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Data submitted successfully');
            return redirect()->back();

        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.add');
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
                                        'image'       => 'sometimes|required',
                                        'name'         => 'required',
                                        'designation'         => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{
            $img = '';
            if($request->hasFile('image'))
            {   
                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/images/', $fileName); 
                $img = '/uploads/images/'.$fileName;      
               
            }
            $team = new TeamMember; 
            $team->image         = $img;
            $team->name          = $request->get('name');
            $team->designation   = $request->get('designation');
            $team->save();

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Team added successfully');
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
        $team = TeamMember::find($id);
        return view('admin.team.edit')->with('member', $team);
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
                                        'image'       => 'required',
                                        'name'         => 'required',
                                        'designation'         => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{
            
            $team = TeamMember::find($id);  
            $team->name          = $request->get('name');
            $team->designation   = $request->get('designation');
            if($request->hasFile('image'))
            {   
                if(file_exists(public_path($request->get('existing_image')))){
                    unlink(public_path($request->get('existing_image')));
                    File::delete(public_path($request->get('existing_image')));
                }

                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/images/', $fileName); 
                $img = '/uploads/images/'.$fileName;      
                $team->image         = $img;
            }
            $team->save();


            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Member Updated successfully');
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

    public function getTeam(Request $request){
         $allTeam = TeamMember::orderBy('created_at','desc')->get();
       
        return DataTables::of($allTeam)
            ->addColumn('image',function($allTeam) {
                $img = '<img src="'. url($allTeam->image) .'" width="100" height="100">';
                return $img;
            })    
            ->addColumn('name',function($allTeam) { 
                return  $allTeam->name;
            })  
            ->addColumn('designation',function($allTeam) {
                return  $allTeam->designation;
            })    
            ->editColumn('created_at',function($allTeam) {
                if(!empty($allTeam->created_at)) {
                    return getDateOnly($allTeam->created_at);
                }
                return 'N/A';
            })
           ->addColumn('action',function($allTeam) {
                $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="'.route('team.edit', $allTeam->id ).'"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Member</a>';

                
                $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteMember(this,'.$allTeam->id.')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Member</a>';
                $str .= '</div></div>';
                return $str;
            }) 
            ->rawColumns(['image','name', 'designation' ,'created_at', 'action'])
            ->make(true);         

    }
}
