<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Cities;
use App\States;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        return view('admin.pages.dashboard');
    }
    public function getCountries(){
        

    }
    public function getStates(Request $request){
        $id = $request->id;
        $states = States::orderBy('name')->where("country_id",$id)
                ->pluck("name","id");
        return response()->json($states);
    }
    public function getCities(Request $request){
        $id = $request->id;
        $cities= Cities::where("state_id",$id)
                ->pluck("name","id");
        return response()->json($cities);
    }
}
