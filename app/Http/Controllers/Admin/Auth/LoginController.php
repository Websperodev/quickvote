<?php

namespace App\Http\Controllers\Admin\Auth;

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
      if(Auth::user()) {   
        return redirect()->route('admin.dashboard');
      }else{
        return redirect()->route('admin.login');
      }
    }
    protected function index(Request $request){
      return view('admin.pages.login');
    }
    protected function login(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required|min:8'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors(['errors', $validator->errors()->all()]);
        }
        try{
          $userData = User::where('email' , $request->email)->first();
          $remember = ($request->has('remember')) ? true : false;

          if(!empty($userData) ){
            $auth = Auth::attempt(
                [
                    'email'     => $request->get('email'),
                    'password'  => $request->get('password')    
                ], $remember
            );
                
            if($auth){
                 return redirect()->route('admin.dashboard');
            }else{
              return redirect()->back()->withErrors(['errors', ['Wrong email or password']]);
            }
            
          }else{
              return redirect()->back()->withErrors(['errors', ['User not found']]);
          }

        }catch (\Exception $e) {
          return  redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }  
    }
    public function logout(Request $request) {
      Auth::logout();
      return redirect('/admin');
    }
}
