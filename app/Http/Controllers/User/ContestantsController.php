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
use Illuminate\Support\Facades\Validator;
use DB;

class ContestantsController extends Controller {

    function index(Request $req, $eId) {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $event = Event::with('country')->where('id', $eId)->first();
//        print_r($req->input()); die;

        if (!empty($event)) {
            $allContestants = Contestant::where('event_id', $eId)->get();
            if ($req->input() && $req->input('cId') != '') {
                $cId = $req->input('cId');
                $constnt_id = $cId;
                $contestants = Contestant::where('id', $cId)->get();
            } else {
                $contestants = Contestant::where('event_id', $eId)->get();
            }
            $totalvotes = VotingContestants::select(DB::Raw('SUM(votes) as total_votes'))->where('event_id', $eId)->first();
            $totalv = $totalvotes->total_votes;
//            echo '<pre>';
//            print_r($contestants); die;
            if (!empty($contestants)) {
                foreach ($contestants as $key => $cont) {

                    $contestvotes = VotingContestants::select(DB::Raw('SUM(votes) as contel_votes'))->where('contestant_id', $cont->id)->first();
//                    print_r($totalvotes->total_votes); die;
                    $totalC = $contestvotes->contel_votes;
                    $percent = $totalC * 100 / $totalv;
                    $contestants[$key]->percentage = (int) $percent;
                }
            }
            $sugstEvent = Event::with('tickets')->where('end_date', '>', $date)->where('category_id', $event->category_id)->limit(3)->get()->toArray();

            return view('user.contestants.list', compact('event', 'contestants', 'sugstEvent', 'constnt_id', 'allContestants'));
        }

//        echo '<pre>';
//        print_r($contestant); die;
    }

    function buyVotesByUser($eId, $cId) {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $event = Event::where('id', $eId)->first();
        $contestants = Contestant::where('id', $cId)->first();
//        echo '<pre>';
//        print_r($event);
//          print_r($contestants); die;
        if (!empty($event) && !empty($contestants) && $contestants->event_id == $eId) {
            $sugstEvent = Event::with('tickets')->where('end_date', '>', $date)->where('category_id', $event->category_id)->limit(3)->get()->toArray();
            return view('user.contestants.votesBuyForm', compact('event', 'contestants', 'sugstEvent'));
        } else {
            echo 'ksjdhfsd';
        }
    }

    function saveBuyVotesByUser(Request $request) {
        $validator = Validator::make($request->all(), [
                    'event_id' => 'required',
                    'contestant_id' => 'required',
                    'votes' => 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|regex:/(01)[0-9]{9}/',
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
            $existing = VotingContestants::where('email', $data['email'])->first();
            if (!empty($existing)) {

                $votingCont = VotingContestants::find($existing->id);
                $votingCont->votes = $data['votes'] + $existing->votes;
                $votingCont->save();
            } else {
                $votingCont = new VotingContestants;
                $votingCont->event_id = (int) $data['event_id'];
                $votingCont->contestant_id = (int) $data['contestant_id'];
                $votingCont->votes = $data['votes'];
                $votingCont->name = $data['name'];
                $votingCont->email = $data['email'];
                $votingCont->phone = (int) $data['phone'];
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
