<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Contestant;
use App\Models\VotingContestants;
use App\Models\Votingcontest;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\PricingPlans;

class ContestantsController extends Controller {

    function index(Request $req, $vId) {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $voting = Votingcontest::where('id', $vId)->first();
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        $testimonials = Testimonial::all();
        $constnt_id = '';
        if (!empty($voting)) {
            $allContestants = Contestant::where('voting_id', $vId)->get();

            if (!empty($req->input()) && $req->input('cId') != '') {
                $cId = $req->input('cId');
                $constnt_id = $cId;
                $contestants = Contestant::where('id', $cId)->get();
            } else {
                $contestants = Contestant::where('voting_id', $vId)->get();
            }

            $totalvotes = VotingContestants::select(DB::Raw('SUM(votes) as total_votes'))->where('voting_id', $vId)->first();
            $totalv = (int) $totalvotes->total_votes;
//            echo '<pre>';
//            print_r($contestants); die;
            if (!empty($contestants)) {
                foreach ($contestants as $key => $cont) {

                    $contestvotes = VotingContestants::select(DB::Raw('SUM(votes) as contel_votes'))->where('contestant_id', $cont->id)->first();
//                    print_r($totalvotes->total_votes); die;
                    if (!empty($contestvotes) && $totalv != 0) {
                        $totalC = $contestvotes->contel_votes;
                        $percent = $totalC * 100 / $totalv;
                        $contestants[$key]->percentage = (int) $percent;
                    } else {
                        $contestants[$key]->percentage = 0;
                    }
                }
            }

            $voting_contest = Votingcontest::where('closing_date', '>', $date)->where('category_id', $voting->category_id)->limit(3)->get();

            return view('user.contestants.list', compact('voting', 'contestants', 'voting_contest', 'constnt_id', 'allContestants', 'slider', 'testimonials'));
        }

//        echo '<pre>';
//        print_r($contestant); die;
    }

    function buyVotesByUser($vId, $cId) {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $vote = Votingcontest::where('id', $vId)->first();
        $contestants = Contestant::where('id', $cId)->first();
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        $testimonials = Testimonial::all();
        if (!empty($vote) && !empty($contestants) && $contestants->voting_id == $vId) {
            $voting_contest = Votingcontest::where('closing_date', '>', $date)->where('category_id', $vote->category_id)->limit(3)->get();
            return view('user.contestants.votesBuyForm', compact('vote', 'contestants', 'voting_contest', 'slider', 'testimonials'));
        } 
    }

    function saveBuyVotesByUser(Request $request) {
        $validator = Validator::make($request->all(), [
                    'voting_id' => 'required',
                    'contestant_id' => 'required',
                    'votes' => 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|regex:/^[0-9]+$/',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $mytime = Carbon::now();

        $date = $mytime->toDateString();
        $time = $mytime->toTimeString();
        $credt = $date . ' ' . $time;
        try {
            $data = $request->all();
            $existing = VotingContestants::where(['email' => $data['email'], 'voting_id' => $data['voting_id'], 'contestant_id' => $data['contestant_id']])->first();
//            print_r($existing); die;
            if (!empty($existing)) {

                $votingCont = VotingContestants::find($existing->id);
                $votingCont->votes = $data['votes'] + $existing->votes;
                $votingCont->update();
            } else {
                $votingCont = new VotingContestants;
                $votingCont->voting_id = $data['voting_id'];
                $votingCont->contestant_id = $data['contestant_id'];
                $votingCont->votes = $data['votes'];
                $votingCont->name = $data['name'];
                $votingCont->email = $data['email'];
                $votingCont->phone = $data['phone'];
                $votingCont->created_at = $credt;
                $votingCont->updated_at = $credt;
                $votingCont->save();
            }

            if ($votingCont->id != '') {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Vote has been bought successfully.');
                return redirect()->back();
            } else {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', 'Vote fail.');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
