<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
       echo "home page";
       die;
        //$res = auth()->user()->givePermissionTo('add event');
       // $res = auth()->user()->assignRole('vendor');
    	//$role = Role::create(['name' => 'vendor']);
        $permission = Permission::create(['name' => 'edit event']);
        //$role = Role::findById(1);
        //$role->givePermissionTo($permission);
       // $permission->assignRole($role);
        //print_r($role);
        //$user = User::role('vendor')->get();
        //print_r($user);
    	//dd('hhhh');
        return view('home');
    }
    public function vendorTest(){
        echo "abcd";
        die;

    }
}
https://localhost:8080/home