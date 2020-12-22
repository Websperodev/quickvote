<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;


class TestController extends Controller
{
   
    public function index()
    {  
        dd('nnnnnnnnn');
        return view('user.pages.homepage');
    }
    
}
