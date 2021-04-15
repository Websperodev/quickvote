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
use Response;

class VotesController extends Controller {

    function index(Request $req, $id) {

        $vote_name = '';
        $searchdate = '';
//        $scatid=$req->input('id');


        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        if ($slider->count() > 0) {
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }
        $testimonials = Testimonial::all();
        if (!empty($req->input())) {
            if ($req->input('vote_name') && $req->input('vote_name') != '') {
                $vote_name = $req->input('vote_name');
                $voting_contest = Votingcontest::where('category_id', $id)
                        ->where('status', 'Accepted')
                        ->where('closing_date', '>', $date)
                        ->where('title', 'like', '%' . $vote_name . '%')
                        ->get();
            }

//            if ($req->input('date') && $req->input('date') != '' && !$req->input('vote_name')) {
//                $searchdate = $req->input('date');
//                $Searchdate = date("Y-m-d", strtotime($req->input('date')));
//                $voting_contest = Votingcontest::where('closing_date', '>', $Searchdate)->get();
//            }
//            if ($req->input('date') && $req->input('date') != '' && $req->input('vote_name')) {
//                $Searchdate = date("Y-m-d", strtotime($req->input('date')));
//                $vote_name = $req->input('vote_name');
//                $searchdate = $req->input('date');
//                $voting_contest = Votingcontest::where('closing_date', '>', $Searchdate)->where('title', 'like', '%' . $vote_name . '%')->get();
//            }
        } else {
            $voting_contest = Votingcontest::where('category_id', $id)
                    ->where('closing_date', '>', $date)
                    ->where('status', 'Accepted')
                    ->get();
        }
        return view('user/votes/votes', compact('voting_contest', 'id', 'sliders', 'testimonials', 'vote_name', 'searchdate'));
    }

    function nonCateVotes(Request $req) {
        $vote_name = '';
        $voting_contest = [];

//        $scatid=$req->input('id');
//   echo $scatid; die;

        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $inArray = ['Non-Category Votes', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        if ($slider->count() > 0) {
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }
        $testimonials = Testimonial::all();

        if ($req->input() && $req->input('vote_name') != '') {

            $vote_name = $req->input('vote_name');

            $voting_contest = Votingcontest::where('category_id', NULL)
                    ->where('status', 'Accepted')
                    ->where('closing_date', '>', $date)
                    ->where('title', 'like', '%' . $vote_name . '%')
                    ->get();
        } else {

            $voting_contest = Votingcontest::where('category_id', NULL)
                    ->where('closing_date', '>', $date)
                    ->where('status', 'Accepted')
                    ->get();
        }
        return view('user/votes/nonCatvotes', compact('voting_contest', 'sliders', 'testimonials', 'vote_name'));
    }

}
