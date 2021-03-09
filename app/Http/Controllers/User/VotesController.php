<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Voting_contest;
use Carbon\Carbon;

class VotesController extends Controller {

    function index() {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $voting_contest = Voting_contest::where('closing_date', '>', $date)->get();
        return view('user/votes/votes', compact('voting_contest'));
    }

}
