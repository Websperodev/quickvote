<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Models\Event;
use App\Models\Cities;
use App\Models\States;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        // $this->middleware('role:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vendorCount = '';
        $eventCount = '';
        $vendorCount = User::where('type','vendor')->count();
        $eventCount = Event::count();
        return view('admin.pages.dashboard', compact('eventCount','vendorCount'));
    }
    public function getCountries(){


    }
    public function getStates(Request $request){
        $id = $request->id;
        $states = States::orderBy('name')->where("country_id",$id)
                ->get(['name','id']);
        return response()->json($states);
    }
    public function getCities(Request $request){
        $id = $request->id;
        $cities = Cities::orderBy('name')->where("state_id",$id)
                ->get(['name','id']);
        return response()->json($cities);
    }
}
