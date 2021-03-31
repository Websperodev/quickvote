<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Models\Cities;
use App\Models\States;

class GetStateCityController extends Controller {

    public function getStates(Request $request) {

        $id = $request->id;
        $states = States::orderBy('name')->where("country_id", $id)
                ->get(['name', 'id']);
        return response()->json($states);
    }

    public function getCities(Request $request) {
        $id = $request->id;
        $cities = Cities::orderBy('name')->where("state_id", $id)
                ->get(['name', 'id']);
        return response()->json($cities);
    }

}
