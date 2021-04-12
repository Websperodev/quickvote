<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Response;
use Mail;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\AccountDetail;
use App\Models\CompanyInformation;
use App\Models\VendorPermissions;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request) {


        $validator = Validator::make($request->all(), [
                    'company_name' => 'required',
                    'company_address' => 'required',
                    'company_country' => 'required',
                    'company_state' => 'required',
                    'company_city' => 'required',
                    'company_phone' => 'required',
                    'company_email' => 'required',
                    'company_website' => 'required',
                    'company_description' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'business_name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'alternate_phone' => 'required',
                    'address1' => 'required',
                    'address2' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'postcode' => 'required',
                    'country' => 'required',
                    'account_holder_name' => 'required',
                    'account_no' => 'required',
                    'bank_name' => 'required',
                    'password' => 'required|min:8'
        ]);
//echo '<pre>';
//print_r($request->input()); die;
        if ($validator->fails()) {
            return Response::json(['success' => false, 'status' => 2, 'errors' => $validator->errors()->all()]);
        }
        try {
            $data = $request->all();

            $existing = User::where('email', $data['email'])->count();
            if ($existing > 0) {
                return Response::json(['success' => false, 'status' => 2, 'errors' => ['Email already exists']]);
            }

            $user = new User;
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->type = 'vendor';
            $user->business_name = $data['business_name'];
            $user->phone = $data['phone'];
            $user->alternate_phone = $data['alternate_phone'];
            $user->address1 = $data['address1'];
            $user->address2 = $data['address2'];
            $user->city_id = $data['city'];
            $user->state_id = $data['state'];
            $user->postal = $data['postcode'];
            $user->country_id = $data['country'];
            $user->save();

            
            $permissions = [['modul_id' => '1', 'vendor_id' => $user->id, 'add' => '1', 'edit' => '0', 'view' => '0', 'delete' => '0'],
                ['modul_id' => '2', 'vendor_id' => $user->id, 'add' => '1', 'edit' => '0', 'view' => '0', 'delete' => '0'],
                ['modul_id' => '3', 'vendor_id' => $user->id, 'add' => '1', 'edit' => '0', 'view' => '0', 'delete' => '0']];
            VendorPermissions::insert($permissions);

            $company = new CompanyInformation();
            $company->vendor_id = $user->id;
            $company->company_name = $data['company_name'];
            $company->address = $data['company_address'];
            $company->city_id = $data['company_country'];
            $company->state_id = $data['company_state'];
            $company->country_id = $data['company_city'];
            $company->phone = $data['company_phone'];
            $company->email = $data['company_email'];
            $company->website = $data['company_website'];
            $company->company_description = $data['company_description'];
            $company->save();

            $account = new AccountDetail();
            $account->vendor_id = $user->id;
            $account->account_holder_name = $data['account_holder_name'];
            $account->account_number = $data['account_no'];
            $account->bank_name = $data['bank_name'];
            $account->save();

            $role = Role::find('2');
            $user->roles()->attach($role);

            $email_content['data'] = 'Vendor Registered successfully';

            $encrypted = $this->my_simple_crypt($user->id, 'e');
            $link = config('constants.email-verify-link') . $encrypted;
            $email_content['link'] = $link;
            $email_information = array('to_email' => $data['email'], 'from_name' => 'QuickVote', 'from_email' => config('app.email'), 'subject' => 'Registration Email');

            Mail::send(['html' => 'vendor.emails.email_register'], $email_content, function ($message) use ($email_information) {
                $message->to($email_information['to_email'])->subject('Registration successfull');
                $message->from('quickvote@gmail.com', 'Quickvote');
            });

            if ($user->id != '') {
                return Response::json(['success' => true, 'status' => 1, 'message' => 'Vendor registered successfully']);
            } else {
                return Response::json(['success' => false, 'status' => 2, 'errors' => ['Registration failed']]);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, 'errors' => [$e->getMessage()]]);
        }
    }

    function my_simple_crypt($string, $action = 'e') {
        $secret_key = 'quickvote_key';
        $secret_iv = 'quickvote_iv';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

}
