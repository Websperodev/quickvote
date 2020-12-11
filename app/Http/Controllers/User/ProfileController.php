<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;
use Session;
use Response;
use App\User;




class ProfileController extends Controller
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
   

    

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password'     => 'required',
            'new_password'     => 'required|min:8|different:old_password',
        ]);

        if ($validator->fails())
        {
            return Response::json(['success' => false, 'status' => 2, 'errors'=> $validator->errors()->all()]);
        }
        
        try{
            $user = Auth::user();

            if (Hash::check($request->old_password, $user->password)) { 
               $user->fill([
                'password' => Hash::make($request->new_password)
                ])->save();

                $request->session()->flash('success', 'Password changed');
                return Response::json(['success' => true, 'status' => 1, 'message' => 'Password changed successfully!!']);

            } else {
                return Response::json(['success' => false, 'status' => 2, 'errors' => ['Password does not match']]);
            }

        }catch (\Exception $e) {
          return Response::json(['success' => false, 'status' => 2, 'errors' => ['Something went wrong']]);
        }
           
           
    }

   
    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
        ]);

        if ($validator->fails())
        {
            return Response::json(['success' => false, 'status' => 2, 'errors'=> $validator->errors()->all()]);
        }

        try{
            $data = $request->all();

            $user = Auth::user();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->phone = $data['phone'];
            $user->update();
            return Response::json(['success' => true, 'status' => 1, 'message' => 'Profile updated successfully!!']);
            
        }catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, 'errors' => ['Something went wrong']]);
            
        } 

    }
   
}
