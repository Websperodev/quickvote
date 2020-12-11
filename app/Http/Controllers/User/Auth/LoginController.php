<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Response;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function index(Request $request)
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

          $userData = User::where('email' , $request->email)->first();
          $remember = ($request->has('remember')) ? true : false;

          if(!empty($userData) ){

            if($userData->email_verified_at == ''){
              return Response::json(['success' => false, 'status' => 2, 'errors' => ['Email Not Verified']]);
            }else{

                $auth = Auth::attempt(
                    [
                        'email'  => $request->get('email'),
                        'password'  => $request->get('password')    
                    ], $remember
                );
                
              if($auth){
                return Response::json(['success' => true, 'status' => 1, 'user_type' => $userData->type  ,'message' => 'Loggedin successfully']);
              }else{
                return Response::json(['success' => false, 'status' => 2, 'errors' => ['Wrong email or password']]);

              }
            }
            
          }else{
              return Response::json(['success' => false, 'status' => 2, 'errors' => ['User not found']]);
          }

        }catch (\Exception $e) {
          return Response::json(['success' => false, 'status' => 2, 'errors' => ['Something went wrong']]);
        }
        
        
        
    }
    public function logout(Request $request) {
      Auth::logout();
      return redirect('/');
    }
}
