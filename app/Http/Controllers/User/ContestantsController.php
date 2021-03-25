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
use Auth;
use App\Models\Slider;
use App\Models\Buy_vote;
use App\Models\Testimonial;
use App\Models\PricingPlans;
use Paystack;
use Response;

class ContestantsController extends Controller {

    function index(Request $req, $vId) {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $voting = Votingcontest::where('id', $vId)->first();
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        $testimonials = Testimonial::all();
        $constnt_id = '';
        $contestants = [];
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
        $user = Auth::user();
        $date = $mytime->toDateString();
        $vote = Votingcontest::where('id', $vId)->first();
        $contestants = Contestant::where('id', $cId)->first();
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        $testimonials = Testimonial::all();
        if (!empty($user) && $user->id != '') {
            $userStatus = "yes";
        } else {
            $userStatus = "no";
        }
//       echo $userStatus; die;
        if (!empty($vote) && !empty($contestants) && $contestants->voting_id == $vId) {
            $voting_contest = Votingcontest::where('closing_date', '>', $date)->where('category_id', $vote->category_id)->limit(3)->get();
            return view('user.contestants.votesBuyForm', compact('vote', 'userStatus', 'contestants', 'voting_contest', 'slider', 'testimonials'));
        }
    }

//    function saveBuyVotesByUser(Request $request) {
////        echo '<pre>';
////        print_r($request->input()); die;
//        $validator = Validator::make($request->all(), [
//                    'voting_id' => 'required',
//                    'contestant_id' => 'required',
//                    'quantity' => 'required',
//                    'name' => 'required',
//                    'email' => 'required|email',
//                    'phone' => 'required|regex:/^[0-9]+$/',
//        ]);
//
//        if ($validator->fails()) {
//            return redirect()->back()->withErrors($validator);
//        }
//        $mytime = Carbon::now();
//
//        $date = $mytime->toDateString();
//        $time = $mytime->toTimeString();
//        $credt = $date . ' ' . $time;
//        try {
//            $data = $request->all();
//            $existing = VotingContestants::where(['email' => $data['email'], 'voting_id' => $data['voting_id'], 'contestant_id' => $data['contestant_id']])->first();
////            print_r($existing); die;
//            if (!empty($existing)) {
//                $votingCont = VotingContestants::find($existing->id);
//                $votingCont->votes = $data['quantity'] + $existing->votes;
//                $votingCont->update();
//            } else {
//                $votingCont = new VotingContestants;
//                $votingCont->voting_id = $data['voting_id'];
//                $votingCont->contestant_id = $data['contestant_id'];
//                $votingCont->votes = $data['quantity'];
//                $votingCont->name = $data['name'];
//                $votingCont->email = $data['email'];
//                $votingCont->phone = $data['phone'];
//                $votingCont->created_at = $credt;
//                $votingCont->updated_at = $credt;
//                $votingCont->save();
//            }
//            $request->session()->flash('message.level', 'success');
//
//            return Paystack::getAuthorizationUrl()->redirectNow($request->session()->flash('message.text', 'Vote has been bought successfully.'));
////            if ($votingCont->id != '') {
////                $request->session()->flash('message.level', 'success');
////                $request->session()->flash('message.text', 'Vote has been bought successfully.');
////                return redirect()->back();
////            } else {
////                $request->session()->flash('message.level', 'danger');
////                $request->session()->flash('message.text', 'Vote fail.');
////                return redirect()->back();
////            }
//        } catch (\Exception $e) {
//            $request->session()->flash('message.level', 'danger');
//            $request->session()->flash('message.text', $e->getMessage());
//            return redirect()->back();
//        }
//    } 
//    function saveBuyVotesByUser(Request $request) {
////        echo '<pre>';
////        print_r($request->input()); die;
//
//        $mytime = Carbon::now();
//        $user = Auth::user();
//        $date = $mytime->toDateString();
//        $time = $mytime->toTimeString();
//        $credt = $date . ' ' . $time;
//        try {
//            $data = $request->all();
//
////            print_r($existing); die;
//            $existing = VotingContestants::where(['email' => $data['email'], 'voting_id' => $data['voting_id'], 'contestant_id' => $data['contestant_id']])->first();
////            print_r($existing); die;
//            if (!empty($existing)) {
//                $votingCont = VotingContestants::find($existing->id);
//                $votingCont->votes = $data['quantity'] + $existing->votes;
//                $votingCont->update();
//                $buy_vote->voting_contestant_id = $votingCont->id;
//            } else {
//                $votingCont = new VotingContestants;
//                $votingCont->voting_id = $data['voting_id'];
//                $votingCont->contestant_id = $data['contestant_id'];
//                $votingCont->votes = $data['quantity'];
//                $votingCont->name = $data['name'];
//                $votingCont->email = $data['email'];
//                $votingCont->phone = $data['phone'];
////                $votingCont->type = $data['votetype'];
//                if ($user->id != '') {
//                    $votingCont->user_id = $user->id;
//                }
//                $votingCont->created_at = $credt;
//                $votingCont->updated_at = $credt;
//
//                $votingCont->save();
//                $id = $votingCont->id;
//                $buy_vote->voting_contestant_id = $id;
//            }
//
//
//            if ($data['votetype'] == 'paid') {
//                $buy_vote = new Buy_vote;
//                $buy_vote->voting_id = $data['voting_id'];
//                $buy_vote->contestant_id = $data['contestant_id'];
//                $buy_vote->total_votes = $data['quantity'];
//                $buy_vote->reference = $data['reference'];
//                $buy_vote->single_vote_fees = $data['fees'];
//                $buy_vote->total_votes_fees = $data['amount'];
//                if ($user->id != '') {
//                    $votingCont->user_id = $user->id;
//                }
//                $buy_vote->created_at = $credt;
//                $buy_vote->updated_at = $credt;
//                $buy_vote->save();
//            }
//            return Response::json(['success' => true, 'status' => 1, 'message' => "Votes has been bought successfully."]);
//        } catch (\Exception $e) {
//            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
//        }
//    }
    function saveBuyVotesByUser(Request $request) {
//        echo '<pre>';
//        print_r($request->input()); die;

        $mytime = Carbon::now();
        $user = Auth::user();
        $date = $mytime->toDateString();
        $time = $mytime->toTimeString();
        $credt = $date . ' ' . $time;
        try {
            $data = $request->all();
            $votingCont = new VotingContestants;
            $votingCont->voting_id = $data['voting_id'];
            $votingCont->contestant_id = $data['contestant_id'];
            $votingCont->votes = $data['quantity'];
            $votingCont->name = $data['name'];
            $votingCont->email = $data['email'];
            $votingCont->phone = $data['phone'];
            $votingCont->type = $data['votetype'];
            if ($user->id != '') {
                $votingCont->user_id = $user->id;
            }
            if ($data['votetype'] == 'paid') {
                $votingCont->total_votes = $data['quantity'];
                $votingCont->reference = $data['reference'];
                $votingCont->single_vote_fees = $data['fees'];
                $votingCont->total_votes_fees = $data['amount'];
                $votingCont->created_at = $credt;
                $votingCont->updated_at = $credt;
            }
            $votingCont->save();
            return Response::json(['success' => true, 'status' => 1, 'message' => "Votes has been bought successfully."]);
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

    public function deleteCity(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'status' => 2, "error" => $validator->errors()->first()]);
        }
        try {
            $City = Cities::find($request->input('id'));

            $City->delete();

            if ($City) {
                return Response::json(['success' => true, 'status' => 1, 'message' => "City has been deleted successfully."]);
            } else {
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback() {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        die;
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }

}
