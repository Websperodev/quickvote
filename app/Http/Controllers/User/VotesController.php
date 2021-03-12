<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Votingcontest;
use Carbon\Carbon;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\PricingPlans;

class VotesController extends Controller {

    function index(Request $req) {
        $vote_name = '';
        $searchdate = '';
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        $testimonials = Testimonial::all();
        if (!empty($req->input())) {
            if ($req->input('vote_name') && !$req->input('date')) {
                $vote_name = $req->input('vote_name');

                $voting_contest = Votingcontest::where('closing_date', '>', $date)->where('title', 'like', '%' . $vote_name . '%')->get();
            }
            if ($req->input('date') && $req->input('date') != '' && !$req->input('vote_name')) {
                $searchdate = $req->input('date');
                $Searchdate = date("Y-m-d", strtotime($req->input('date')));
                $voting_contest = Votingcontest::where('closing_date', '>', $Searchdate)->get();
            }
            if ($req->input('date') && $req->input('date') != '' && $req->input('vote_name')) {
                $Searchdate = date("Y-m-d", strtotime($req->input('date')));
                $vote_name = $req->input('vote_name');
                $searchdate = $req->input('date');
                $voting_contest = Votingcontest::where('closing_date', '>', $Searchdate)->where('title', 'like', '%' . $vote_name . '%')->get();
            }
        } else {
            $voting_contest = Votingcontest::where('closing_date', '>', $date)->get();
        }
        return view('user/votes/votes', compact('voting_contest', 'slider', 'testimonials', 'vote_name', 'searchdate'));
    }

}
