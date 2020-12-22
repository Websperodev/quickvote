<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;
use Session;
use Response;
use App\User;
use App\Cities;
use App\States;
use App\Countries;




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
    public function index()
    {   
        return view('admin.pages.dashboard');
    }

    public function openChangePassword(){
        return view('admin.pages.change-password');

    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password'     => 'required',
            'new_password'     => 'min:8|required_with:confirm_password|same:confirm_password|different:old_password',
            'confirm_password' => 'required|min:8',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        
        try{
            $user = Auth::user();

            if (Hash::check($request->old_password, $user->password)) { 
               $user->fill([
                'password' => Hash::make($request->new_password)
                ])->save();
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Password changed successfully.');
                return redirect()->back();
            } else {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', 'Password does not match.');
                return redirect()->back();
            }

        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', 'Something went wrong.');
            return redirect()->back();
            
        }           
    }

    public function myAccount(Request $request){
        $user = Auth::user();
        $countries = Countries::get();
        $states = States::get();
        $cities = Cities::get();
        return view('admin.pages.my-account')->with(['user' => $user, 'countries' => $countries, 'states' => $states, 'cities' => $cities,]);
    }
    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        try{
            $data = $request->all();

            $user = Auth::user();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->business_name = $data['business_name'];
            $user->contact_name = $data['contact_name'];
            $user->phone = $data['phone'];
            $user->alternate_phone = $data['alternate_phone'];
            $user->address1 = $data['address1'];
            $user->address2 = $data['address2'];
            $user->city_id = $data['city'];
            $user->state_id = $data['state'];
            $user->postal = $data['postal'];
            $user->country_id = $data['country'];
            $user->description = $data['description'];
            $user->update();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Profile updated successfully.');
            return redirect()->back();
            
        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back();
            
        } 

    }
   
}
