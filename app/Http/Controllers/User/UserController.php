<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Countries;


class UserController extends Controller
{
   
    public function index()
    {  
        $countries = Countries::get();
        return view('user.pages.homepage')->with(['countries' => $countries]);
    }
    public function vendorTest(){
        echo "abcd";
        die;

    }
}
