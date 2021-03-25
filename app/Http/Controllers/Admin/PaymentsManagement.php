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
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="' . route('admin.edit-user', ['id' => $allVotes['id']]) . '"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit User</a>';
                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteUser(this,' . $allVotes['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete User</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['contestant_id', 'voting_id','created_at', 'action'])
                        ->make(true);
//                          echo '<pre>';
//        print_r($allVotes); die;
    }

}
