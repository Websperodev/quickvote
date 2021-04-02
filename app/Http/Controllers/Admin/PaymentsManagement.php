<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Session;
use Response;
use App\User;
use App\Models\Cities;
use App\Models\States;
use App\Models\Countries;
use App\Models\ModelHasRoles;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Models\Votingcontest;
use App\Models\VotingContestants;
use App\Models\buyTicketsDetails;
use App\Models\EventTicketsPayments;

class PaymentsManagement extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    function votesIndex() {
        return view('admin/payments/votesPaymentList');
    }

    public function allVotes(Request $request) {
        $allVotes = VotingContestants::orderBy('created_at', 'desc')->get();

        return DataTables::of($allVotes)
                        ->addColumn('contestant_id', function ($allVotes) {
                            return contestant_name($allVotes->contestant_id);
                        })
                        ->addColumn('voting_id', function ($allVotes) {
                            return votingTitle($allVotes->voting_id);
                        })
                        ->editColumn('created_at', function ($allVotes) {
                            if (!empty($allVotes->created_at)) {
                                return getDateOnly($allVotes->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function ($allVotes) {
                            $str = '<div class="btn-group dropdown"></div></div>';
                            return $str;
                        })
                        ->rawColumns(['contestant_id', 'voting_id', 'created_at', 'action'])
                        ->make(true);
//                          echo '<pre>';
//        print_r($allVotes); die;
    }

    function eventTicketsIndex() {
        return view('admin/payments/eventTicketsPaymentList');
    }

    public function allEventTickets(Request $request) {
        $allTickets = EventTicketsPayments::orderBy('created_at', 'desc')->get();

        return DataTables::of($allTickets)
                        ->addColumn('event_id', function ($allTickets) {
                            return eventsName($allTickets->event_id);
                        })
                        ->addColumn('ticket_id', function ($allTickets) {
                            return ticketName($allTickets->ticket_id);
                        })
                        ->editColumn('ticket_number', function ($allTickets) {
                            return ticketNumber($allTickets->ticket_id);
                        })
                        ->addColumn('reference', function ($allTickets) {
                            if ($allTickets->reference == '') {
                                return '__';
                            } else {
                                return $allTickets->reference;
                            }
                        })
                        ->editColumn('created_at', function ($allTickets) {
                            if (!empty($allTickets->created_at)) {
                                return getDateOnly($allTickets->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function ($allTickets) {
                            $str = '<div class="btn-group dropdown"></div></div>';
                            return $str;
                        })
                        ->rawColumns(['contestant_id', 'voting_id', 'created_at', 'action'])
                        ->make(true);
//                          echo '<pre>';
//        print_r($allVotes); die;
    }

}
