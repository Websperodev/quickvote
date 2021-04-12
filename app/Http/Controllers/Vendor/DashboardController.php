<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use DB;
use App\Models\Event;
use App\Models\Cities;
use App\Models\States;
use Response;

class DashboardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:vendor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('vendor.pages.dashboard');
    }

    public function changePassword() {
        return view('vendor.pages.change-password');
    }

    public function getSubcategories(Request $request) {
        $id = $request->id;
        $states = DB::table('categories')->orderBy('name')->where("parent_id", $id)
                ->get(['name', 'id']);
        return response()->json($states);
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
