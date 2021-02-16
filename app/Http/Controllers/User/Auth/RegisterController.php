<?php

namespace App\Http\Controllers\User\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Mail;
use Auth;
use Session;
use Response;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Countries;
use App\Models\Testimonial;
use App\Models\PricingPlans;
use App\Models\ContactQuerie;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
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
            'email'     => 'required',
            'password'  => 'required|min:8'
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
            $user->email = $data['email'];
            $user->type = 'user';
            $user->password = Hash::make($data['password']);
            $user->save();
            
            $email_content['data'] = 'User Registered successfully';

            $encrypted = $this->my_simple_crypt($user->id, 'e' );
            $link = config('constants.email-verify-link').$encrypted;
            $email_content['link'] = $link;
            $email_information = array('to_email'=> $data['email'],'from_name'=>'QuickVote','from_email'=>config('app.email'),'subject'=>'Registration Email');
            
                
            Mail::send(['html' => 'user.emails.email_register'], $email_content, function($message) use ($email_information)
            {
                $message->to($email_information['to_email'])->subject('Registration successfull');
                $message->from('quickvote@gmail.com','Quickvote');
            });

            if($user->id){
                return Response::json(['success' => true, 'status' => 1, 'message' => 'Registered Successfully!!']);
            }else{
                return Response::json(['success' => false, 'status' => 2, 'errors' => ['Registration failed']]);
            }
        }catch (\Exception $e) {
          return Response::json(['success' => false, 'status' => 2, 'errors' => $e->getMessage()]);
        }
        
    }

    public function varifyEmail(Request $request){
        $data = $request->all();
        $userId = $data['id'];
        
        $userId = $this->my_simple_crypt($userId, 'd' );
        $userData = User::find($userId);
        if(!empty($userData)){
            if($userData->email_verified_at == ''){
                $userData->email_verified_at = Carbon::now();
                $userData->update();
                Auth::loginUsingId($userId);
                return redirect('/')->with('message','Email Verified Successfully!');
            }else{
                return redirect('/')->with('message','Already Verified!');
            }
        }else{
            return redirect('/')->with('message','Link Expired');
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

    public function forgetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
        ]);

        if ($validator->fails())
        {
            return Response::json(['success' => false, 'status' => 2, 'errors'=> $validator->errors()->all()]);
        }
        try{
            $user = User::where('email', $request->email)->first();

            if(!empty($user) && $user->id != ''){
                $email_content['data'] = 'Password reset';

                $encrypted = $this->my_simple_crypt($user->id, 'e' );
                $link = config('constants.reset-password-link').$encrypted;
                $email_content['link'] = $link;
                $email_information = array('to_email'=> $user->email,'from_name'=>'QuickVote','from_email'=>config('app.email'),'subject'=>'Registration Email');
                
                    
                Mail::send(['html' => 'user.emails.password_reset'], $email_content, function($message) use ($email_information)
                {
                    $message->to($email_information['to_email'])->subject('Password Reset');
                    $message->from('quickvote@gmail.com','Quickvote');
                });

                return Response::json(['success' => true, 'status' => 1, 'message' => 'Password reset link sent successfully!!']);
            }else{
                return Response::json(['success' => false, 'status' => 2, 'errors' => ['Email not registered']]);
            }

        }catch (\Exception $e) {
          return Response::json(['success' => false, 'status' => 2, 'errors' => ['Something went wrong']]);
        }
        

    }
    public function openResetPassword(Request $request){
        $data = $request->all();
        $userId = $data['id'];
      
        $userId = $this->my_simple_crypt($userId, 'd' );
        $userData = User::find($userId);
        if(!empty($userData)){
            $countries = Countries::get();
            $pageData = [];
            $sliders = [];
            $data = Page::where('page_name', 'home')->get();
            if($data->count() > 0){
                foreach($data as $val){
                    $pageData[$val->section] = $val;
                }
                    
            }
            $inArray = ['home','trusted brands'];
            $slider = Slider::whereIn('name',$inArray)->get();
            $testimonials = Testimonial::all();
            if($slider->count() > 0){
                foreach($slider as $val){
                    $sliders[$val->name][] = $val;
                }       
            }
        $pricingData = PricingPlans::get();

        
        return view('user.pages.homepage')->with(['page' => 'forgetPassword', 'user_id' => $userId, 'countries' => $countries, 'pageData' => $pageData, 'pricingData' => $pricingData , 'sliders' => $sliders, 'testimonials' => $testimonials ]);
        }else{
            return redirect('/')->with('message','Link Expired');
        }
    }
    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password'     => 'required',
        ]);
        if ($validator->fails())
        {
            return Response::json(['success' => false, 'status' => 2, 'errors'=> $validator->errors()->all()]);
        }
        try{
            $user = User::find($request->user_id);
            if(!empty($user)){
                $user->password = Hash::make($request->password);
                $user->update();
                return Response::json(['success' => true, 'status' => 1, 'message' => 'Password reset successfully!!']);
            }else{
                return Response::json(['success' => false, 'status' => 2, 'errors' => ['User not found']]);
            }

        }catch (\Exception $e) {
          return Response::json(['success' => false, 'status' => 2, 'errors' => ['Something went wrong']]);
        }       
    }

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

    public function sendContact(Request $request){
       
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email',
            'subject'  => 'required',
            'phone'    => 'required',
            'message'  => 'required',
        ]);

        if ($validator->fails())
        {
            return Response::json(['success' => false, 'status' => 2, 'errors'=> $validator->errors()->all()]);
        }
        try{

            $query = new ContactQuerie();
            $query->name = $request->get('name');
            $query->email = $request->get('email');
            $query->subject = $request->get('subject');
            $query->phone = $request->get('phone');
            $query->message = $request->get('message');
            $query->save();
            return Response::json(['success' => true, 'status' => 1, 'message' => 'Request Submitted Successfully!!']);

        }catch (\Exception $e) {
          return Response::json(['success' => false, 'status' => 2, 'errors' => [$e->getMessage()]]);
        }
    }
    
}
