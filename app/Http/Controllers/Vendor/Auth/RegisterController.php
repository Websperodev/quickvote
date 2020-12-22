<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Response;
use Mail;
use Auth;
use Session;
use Carbon\Carbon;

class RegisterController extends Controller
{
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
    protected function create(Request $request)
    {  
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email'      => 'required',
            'password'   => 'required|min:8'
        ]);

        if ($validator->fails())
        {
            return Response::json(['success' => false, 'status' => 2, 'errors'=> $validator->errors()->all()]);
        }
        try{
            $data = $request->all();
            $existing = User::where('email', $data['email'])->count();
            if($existing > 0){
                return Response::json(['success' => false, 'status' => 2, 'errors' => ['Email already exists']]);
            }
            $user = new User;
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->password =  Hash::make($data['password']);
            $user->type = 'vendor';
            $user->business_name = $data['business_name'];
            $user->contact_name = $data['contact_name'];
            $user->phone = $data['phone'];
            $user->alternate_phone = $data['alternate_phn'];
            $user->address1 = $data['address1'];
            $user->address2 = $data['address2'];
            $user->city_id = $data['city'];
            $user->state_id = $data['state'];
            $user->postal = $data['postal'];
            $user->country_id = $data['country'];
            $user->description = $data['description'];
            $user->save();

            $role = Role::find('2');
            $user->roles()->attach($role);

            $email_content['data'] = 'Vendor Registered successfully';

            $encrypted = $this->my_simple_crypt($user->id, 'e' );
            $link = config('constants.email-verify-link').$encrypted;
            $email_content['link'] = $link;
            $email_information = array('to_email'=> $data['email'],'from_name'=>'QuickVote','from_email'=>config('app.email'),'subject'=>'Registration Email');
            
                
            Mail::send(['html' => 'vendor.emails.email_register'], $email_content, function($message) use ($email_information)
            {
                $message->to($email_information['to_email'])->subject('Registration successfull');
                $message->from('quickvote@gmail.com','Quickvote');
            });

            if($user->id != ''){
                return Response::json(['success' => true, 'status' => 1, 'message' => 'Vendor registered successfully']);
            }else{
                return Response::json(['success' => false, 'status' => 2, 'errors' => ['Registration failed']]);
            }
        }catch (\Exception $e) {
          return Response::json(['success' => false, 'status' => 2, 'errors' => ['Something went wrong']]);
        }
        
    }

   
    function my_simple_crypt( $string, $action = 'e' ) {
        $secret_key = 'quickvote_key';
        $secret_iv = 'quickvote_iv';
     
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
     
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
     
        return $output;
    }
   
    
    
}
