<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;
use Auth;
use Exception;
use App\Services\SocialTwitterAccountService;

class SocialController extends Controller
{

	public function redirect($provider)
	{
	    return Socialite::driver($provider)->redirect();
	}

	public function callback($provider)
	{ 
	   $getInfo = Socialite::driver($provider)->stateless()->user(); 
	   $user = $this->createUser($getInfo,$provider); 
	   Auth::login($user);
	   return redirect('/#');
	}
	public function twitterCallback(SocialTwitterAccountService $service)
    {	
    	$getInfo = Socialite::driver('twitter')->user(); 
    	print_r($getInfo);
    	dd('dsjfjsdg');
        $user = $service->createOrGetUser(Socialite::driver('twitter')->user());
        Auth::login($user);
	    return redirect('/#');
    }

	function createUser($getInfo,$provider){
	 	$user = User::where('provider_id', $getInfo->id)->first();
	 	$fname = '';
		$lname = '';
	 	if ($getInfo->name == trim($getInfo->name) && strpos($getInfo->name, ' ') !== false) {
			$name = explode(' ',$getInfo->name);
			if(!empty($name)){
				$fname = $name[0];
				$lname = $name[1];
			}else{
				$fname = $getInfo->name;
			}
		}
		if(!$user) {
		    $user = User::create([
		        'first_name'     => $fname,
		        'last_name'      => $lname,
		        'email'    		 => $getInfo->email,
		        'provider' 		 => $provider,
		        'provider_id' 	 => $getInfo->id
		    ]);
		}
	   return $user;
	}

	public function redirectToGoogle()
	{
	    return Socialite::driver('google')->redirect();
	}

	public function handleGoogleCallback()
	{
	    try{
	    
	        $user = Socialite::driver('google')->user();
	        $finduser = User::where('google_id', $user->id)->first(); 

	        $fname = '';
			$lname = '';
		 	if ($user->name == trim($user->name) && strpos($user->name, ' ') !== false) {
				$name = explode(' ',$user->name);
				if(!empty($name)){
					$fname = $name[0];
					$lname = $name[1];
				}else{
					$fname = $getInfo->name;
				}
			}
	        
	        if($finduser){
	            Auth::login($finduser);
	            return redirect('/home');
	        }else{
	            $newUser = User::create([
	                'first_name'     => $fname,
		        	'last_name'      => $lname,
	                'email' 	     => $user->email,
	                'google_id'		 => $user->id,
	                'password'       => encrypt('123456dummy')
	            ]);
	            Auth::login($newUser);
	            return redirect('/#');
	        }

	    } catch (Exception $e) {
	        dd($e->getMessage());
	    }
	}


}