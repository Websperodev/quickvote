<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;


class HomeController extends Controller
{
   
    public function index()
    {  
        dd('gggggggggggg');
        return view('user.pages.homepage');
    }
    public function vendorTest(){
        echo "abcd";
        die;

    }
}
