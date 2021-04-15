<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Votingcontest;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Auth;
use Response;
use App\Models\Categories;

class VotingContestsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('admin.votingContests.index');
    }

    public function addVotingContest(Request $request) {
        $user = Auth::user();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                        'category' => 'required',
                        'category_id' => 'required_if:category,==,2|nullable',
                        'type' => 'required',
                        'fees' => 'required_if:type,==,paid|nullable',
                        'limit' => 'required',
                        'limit_count' => 'required_if:limit,==,1|nullable',
                        'packages' => 'required',
                        'title' => 'required',
                        'starting_date' => 'required',
                        'closing_date' => 'required',
                        'timezone' => 'required',
                        'description' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            try {

                $data = $request->all();
                $existing = Votingcontest::where('title', $data['title'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Voting Contest already exists');
                    return redirect()->back();
                }
                $votingContest = new Votingcontest;

                $votingContest->category = $data['category'];
                $votingContest->type = $data['type'];
                $votingContest->limit = $data['limit'];
                if ($data['limit'] == '1') {
                    $votingContest->limit_count = $data['limit_count'];
                } else {
                    $votingContest->limit_count = NULL;
                }
                if ($data['category'] == '2') {
                    $votingContest->category_id = $data['category_id'];
                } else {
                    $votingContest->category_id = NULL;
                }

                $votingContest->packages = $data['packages'];
                $votingContest->title = $data['title'];
                if (isset($data['fees']) && $data['fees'] != '') {
                    $votingContest->fees = $data['fees'];
                    $votingContest->payment_gateway = 'paystack';
                } else {
                    $votingContest->fees = NULL;
                    $votingContest->payment_gateway = NULL;
                }

                $votingContest->timezone = $data['timezone'];
                $votingContest->description = $data['description'];

                $sDate = date_create($data['starting_date']);
                $starting_date = date_format($sDate, "Y-m-d H:i");
                $CDate = date_create($data['closing_date']);
                $closing_date = date_format($CDate, "Y-m-d H:i");

//                print_r($starting_date);
//                echo '<br>';
//                echo $closing_date;die;
//                 $sDate = str_replace('/', '-', $data['starting_date']);
//                    $starting_date = date("Y-m-d H:i", strtotime($sDate));
//                    $CDate = str_replace('/', '-', $data['closing_date']);
//                    $closing_date = date("Y-m-d H:i", strtotime($CDate));

                $votingContest->starting_date = $starting_date;
                $votingContest->closing_date = $closing_date;
                $votingContest->status = 'Accepted';
                $votingContest->added_by = $user->id;

                if ($request->hasFile('image')) {
                    if ($request->file('image')->isValid()) {
                        $validated = $request->validate([
                            'image' => 'string|max:40',
                            'image' => 'mimes:jpeg,png|max:1014',
                        ]);
                        $file = request()->file('image');
                        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                        $file->move('./uploads/images/', $fileName);
                        $img = '/uploads/images/' . $fileName;
                        $votingContest->image = $img;
                    }
                }
//                print_r('jhfgsadj'); die;
                $votingContest->save();

                if ($votingContest->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'Voting Contest Added successfully.');
                    return redirect()->back();
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Voting Contest fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        if ($request->isMethod('get')) {
            $categories = Categories::where('parent_id', '!=', '0')->get();
            return view('admin.votingContests.add', compact('categories'));
        }
    }

    public function allvotingContests(Request $request) {
        $allvotingContests = Votingcontest::orderBy('created_at', 'desc')->get();
// echo '<pre>';
// print_r($allvotingContests); die;
        return DataTables::of($allvotingContests)
                        ->addColumn('title', function ($allvotingContests) {
                            return $allvotingContests->title;
                        })
                        ->addColumn('image', function ($allvotingContests) {
                            $img = '-';
                            if ($allvotingContests->image != '') {
                                $img = '<img src="' . url($allvotingContests->image) . '" width="100" height="100">';
                            }

                            return $img;
                        })
                        ->editColumn('starting_date', function ($allvotingContests) {
                            if (!empty($allvotingContests->starting_date)) {
                                return getDateOnly($allvotingContests->starting_date);
                            }
                            return 'N/A';
                        })
                        ->editColumn('closing_date', function ($allvotingContests) {
                            if (!empty($allvotingContests->closing_date)) {
                                return getDateOnly($allvotingContests->closing_date);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function ($allvotingContests) {
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="' . route('admin.edit.voting', ['id' => $allvotingContests['id']]) . '"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Voting Contest</a>';
                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteVotingContest(this,' . $allvotingContests['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Voting Contest</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['title', 'image', 'starting_date', 'closing_date', 'action'])
                        ->make(true);
    }

    public function editVotingContest(Request $request) {
        $user = Auth::user();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'category' => 'required',
                        'category_id' => 'required_if:category,==,2|nullable',
                        'status' => 'required',
                        'reason' => 'required_if:status,==,Rejected|nullable',
                        'type' => 'required',
                        'limit' => 'required',
                        'limit_count' => 'required_if:limit,==,1|nullable',
                        'packages' => 'required',
                        'title' => 'required',
                        'fees' => 'required_if:type,==,paid|nullable',
                        'starting_date' => 'required',
                        'closing_date' => 'required',
                        'timezone' => 'required',
                        'description' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            try {
                $data = $request->all();
                $existing = Votingcontest::where('title', '=', $data['title'])->where('id', '!=', $data['VotingContest_id'])->count();

                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Voting Contest already exists');
                    return redirect()->back();
                }

                $votingContest = Votingcontest::find($data['VotingContest_id']);
                $votingContest->category = $data['category'];
                $votingContest->type = $data['type'];
                $votingContest->limit = $data['limit'];
                if ($data['limit'] == '1') {
                    $votingContest->limit_count = $data['limit_count'];
                } else {
                    $votingContest->limit_count = NULL;
                }
                if ($data['category'] == '2') {
                    $votingContest->category_id = $data['category_id'];
                } else {
                    $votingContest->category_id = NULL;
                }
                if (isset($data['fees']) && $data['fees'] != '') {
                    $votingContest->fees = $data['fees'];
                    $votingContest->payment_gateway = 'paystack';
                } else {
                    $votingContest->fees = NULL;
                    $votingContest->payment_gateway = NULL;
                }
                $votingContest->packages = $data['packages'];
                $votingContest->title = $data['title'];
                $votingContest->timezone = $data['timezone'];
                $votingContest->description = $data['description'];
                $votingContest->status = $data['status'];

                if ($data['status'] == 'Rejected' && $data['reason'] != '') {
                    $votingContest->reason = $data['reason'];
                } else {
                    $votingContest->reason = NULL;
                }
//                $sDate = str_replace('/', '-', $data['starting_date']);
//                $starting_date = date("Y-m-d H:i", strtotime($sDate));
//                $CDate = str_replace('/', '-', $data['closing_date']);
//                $closing_date = date("Y-m-d H:i", strtotime($CDate));
                $sDate = date_create($data['starting_date']);
//                print_r($data['starting_date']); die;
                $starting_date = date_format($sDate, "Y-m-d H:i");

                $CDate = date_create($data['closing_date']);
                $closing_date = date_format($CDate, "Y-m-d H:i");
//                     print_r($starting_date); 
//                     echo '<br>';
//                 print_r($closing_date); die;
                $votingContest->starting_date = $starting_date;
                $votingContest->closing_date = $closing_date;
//                $votingContest->starting_date = date("Y-m-d H:i", strtotime($data['starting_date']));
//                $votingContest->closing_date = date("Y-m-d H:i", strtotime($data['closing_date']));

                if ($request->hasFile('image')) {
                    if ($request->file('image')->isValid()) {
                        $validated = $request->validate([
                            'image' => 'string|max:40',
                            'image' => 'mimes:jpeg,png|max:1014',
                        ]);
                        $file = request()->file('image');
                        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                        $file->move('./uploads/images/', $fileName);
                        $img = '/uploads/images/' . $fileName;
                        $votingContest->image = $img;
                    }
                }

                $votingContest->update();

                if ($votingContest->id != '') {

                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'Voting contest Updated successfully.');
                    return redirect()->back();
                } else {

                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back();
            }
        }
        if ($request->isMethod('get')) {
            $id = $request->get('id');
            $VotingContest = Votingcontest::find($id);
            $categories = Categories::where('parent_id', '!=', '0')->get();
            $VotingContest->viewstart_date = date("m/d/Y H:i", strtotime($VotingContest->starting_date));
            $VotingContest->viewclosing_date = date("m/d/Y H:i", strtotime($VotingContest->closing_date));
            return view('admin.votingContests.edit', compact('VotingContest', 'categories'));
        }
    }

    public function deleteVotingContest(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return Response::json(['success' => false, 'status' => 2, "error" => $validator->errors()->first()]);
        }

        try {

            $votingContest = Votingcontest::find($request->input('id'));
//            echo '<pre>';
//            print_r($VotingContest ); die;
            if ($votingContest->image != '' && file_exists(public_path($votingContest->image))) {
                unlink(public_path($votingContest->image));
                File::delete(public_path($votingContest->image));
            }

            $votingContest->delete();

            if ($votingContest) {

                return Response::json(['success' => true, 'status' => 1, 'message' => "Voting Contest has been deleted successfully."]);
            } else {

                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
                die;
            }
        } catch (\Exception $e) {

            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
            die;
        }
    }

}
