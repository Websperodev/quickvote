<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Session;
use Response;
use App\User;
use App\Models\Countries;
use App\Models\CompanyInformation;

class ProfileController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:vendor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('vendor.pages.dashboard');
    }

    public function openChangePassword() {
        return view('vendor.pages.change-password');
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
                    'old_password' => 'required',
                    'new_password' => 'min:8|required_with:confirm_password|same:confirm_password|different:old_password',
                    'confirm_password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        try {
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
        } catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', 'Something went wrong.');
            return redirect()->back();
        }
    }

    public function myAccount(Request $request) {
        $user = Auth::user();
        $countries = Countries::get();
        return view('vendor.pages.my-account', compact('user', 'countries'));
    }

    public function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'gender' => array(
                        'required',
                        'regex:/^male$|^female$/'),
                    'facebook' => 'nullable|regex:/(https?:\/\/)?([\w\.]*)facebook\.com\/([a-zA-Z0-9_]*)$/',
                    'instagram' => 'nullable|regex:/(https?:\/\/)?([\w\.]*)instagram\.com\/([a-zA-Z0-9_]*)$/',
                    'twitter' => 'nullable|regex:/(https?:\/\/)?([\w\.]*)twitter\.com\/([a-zA-Z0-9_]*)$/',
                    'image' => 'mimes:jpeg,png|max:1014',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        try {
            $data = $request->all();
            $img = '';
            $user = Auth::user();
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    // $validated = $request->validate([
                    //     'image' => 'string|max:40',
                    //     'image' => 'mimes:jpeg,png|max:1014',
                    // ]);
                    $file = request()->file('image');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName);
                    $img = '/uploads/images/' . $fileName;
                }
            }
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->business_name = $data['business_name'];
            $user->alternate_phone = $data['alternate_phone'];
            $user->address1 = $data['address1'];
            $user->gender = $data['gender'];
            $user->address2 = $data['address2'];
            $user->city_id = $data['city'];
            $user->state_id = $data['state'];
            if ($img != '') {
                $user->image = $img;
            }
            $user->postal = $data['postal'];
            $user->country_id = $data['county'];
            $user->facebook = $data['facebook'];
            $user->twitter = $data['twitter'];
            $user->instagram = $data['instagram'];
            // $user->description = $data['description'];
            $user->update();

            $company = CompanyInformation::where('vendor_id', $user->id)->first();
            $company->company_name = $data['company_name'];
            $company->company_description = $data['description'];
            $company->update();

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Profile updated successfully.');

            return redirect()->back();
        } catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back();
        }
    }

}
