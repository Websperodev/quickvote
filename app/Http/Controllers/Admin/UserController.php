<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;
use Session;
use Response;
use App\User;

use Yajra\Datatables\Datatables;




class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        return view('admin.user.index');
    }

    public function addUser(Request $request){
        if($request->isMethod('post')){ 
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'email'      => 'required',
                'password'   => 'required|min:8',
                'user_type'  => 'required',
            ]);

            if ($validator->fails())
            {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $validator->errors()->all());
                return redirect()->back();
            }
            try{
                $data = $request->all();
                $existing = User::where('email', $data['email'])->count();
                if($existing > 0){
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Email already exists');
                    return redirect()->back();
                }

                $user = new User;
                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->email = $data['email'];
                $user->password =  Hash::make($data['password']);
                $user->type = $data['user_type'];
                $user->business_name = $data['business_name'];
                $user->contact_name = $data['contact_name'];
                $user->phone = $data['phone'];
                $user->alternate_phone = $data['alternate_phone'];
                $user->address1 = $data['address1'];
                $user->address2 = $data['address2'];
                $user->city = $data['city'];
                $user->state = $data['state'];
                $user->postal = $data['postal'];
                $user->country = $data['county'];
                $user->description = $data['description'];
                $user->save();
                if($data['user_type'] == 'vendor'){
                    $role = Role::find('2');
                    $user->roles()->attach($role);
                }else{
                    $role = Role::find('3');
                    $user->roles()->attach($role);
                }
                
            
                if($user->id != ''){
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'User Added successfully.');
                    return redirect()->back();
                }else{
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Registeration fail.');
                    return redirect()->back();
                }
            }catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back();
            }
        }
        if($request->isMethod('get')){
            return view('admin.user.add');
        }
    }

    public function allUsers(Request $request){
        $allUsers = User::where('id','!=', Auth::user()->id)->orderBy('created_at','desc')->get();
       
        return DataTables::of($allUsers)
            ->addColumn('name',function($allUsers) {
                $userName  = '';
                $firstName  = isset($allUsers->first_name) ? $allUsers->first_name : '';
                $lastName  = isset($allUsers->last_name) ? $allUsers->last_name : '';;
                $userName  = $firstName.' '.$lastName;
                return $userName;
            })    
            ->addColumn('email',function($allUsers) {
                return $allUsers->email;
            })    
            ->editColumn('type',function($allUsers) {
                return $allUsers->type;  
            })
            ->editColumn('created_at',function($allUsers) {
                if(!empty($allUsers->created_at)) {
                    return getDateOnly($allUsers->created_at);
                }
                return 'N/A';
            })
           ->addColumn('action',function($allUsers) {
                $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="'.route('admin.edit-user',['id'=>$allUsers['id']]).'"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit User</a>';

                
                $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteUser(this,'.$allUsers['id'].')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete User</a>';
                $str .= '</div></div>';
                return $str;
            }) 
            ->rawColumns(['name','email', 'gender','created_at', 'action'])
            ->make(true);         
    }

    public function editUser(Request $request){
       if($request->isMethod('post')){ 
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'email'      => 'required',
                'user_type'  => 'required',
            ]);

            if ($validator->fails())
            {   
                return redirect()->back()->withErrors($validator)->withInput();  
            }
            try{
                $data = $request->all();
                $existing = User::where('email' ,'=', $data['email'])->where('id' ,'!=', $data['user_id'])->count();
                if($existing > 0){
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'User already exists');
                    return redirect()->back();
                }

                $user = User::find($data['user_id']);
                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->type = $data['user_type'];
                $user->business_name = $data['business_name'];
                $user->contact_name = $data['contact_name'];
                $user->phone = $data['phone'];
                $user->alternate_phone = $data['alternate_phone'];
                $user->address1 = $data['address1'];
                $user->address2 = $data['address2'];
                $user->city = $data['city'];
                $user->state = $data['state'];
                $user->postal = $data['postal'];
                $user->country = $data['county'];
                $user->description = $data['description'];
                $user->update();
                if($data['user_type'] == 'vendor'){
                    $role = Role::find('2');
                    $user->roles()->attach($role);
                }else{
                    $role = Role::find('3');
                    $user->roles()->attach($role);
                }
                
            
                if($user->id != ''){
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'User Updated successfully.');
                    return redirect()->back();
                }else{
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'fail.');
                    return redirect()->back();
                }
            }catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back();
            }
        }
        if($request->isMethod('get')){
            $id = $request->get('id');
            $user = User::find($id);
            return view('admin.user.edit')->with('user',$user);
        }
    }

     public function deleteuser(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'status' => 2, "error" => $validator->errors()->first()]);
        }
        try{
            $user = User::find($request->input('id'));
            $user->delete();
           
            if($user){
                return Response::json(['success' => true, 'status' => 1, 'message' => "User has been deleted successfully."]);
            }else{
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        }catch(\Exception $e){
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }  
    }
    
   
}