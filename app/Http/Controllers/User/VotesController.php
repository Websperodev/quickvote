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

    function index() {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
          $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        $testimonials = Testimonial::all();
        $voting_contest = Votingcontest::where('closing_date', '>', $date)->get();
        return view('user/votes/votes', compact('voting_contest','slider','testimonials'));
    }

}
