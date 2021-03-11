<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Models\Countries;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        $countries = Countries::get(); 
        return view('user.pages.dashboard',compact('countries'));
    }
    public function vendorTest(){
        echo "abcd";
        die;

    }
}
