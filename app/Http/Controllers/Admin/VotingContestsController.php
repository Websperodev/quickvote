<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voting_contest;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Auth;

class VotingContestsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
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
        if ($request->isMethod('post')) {
//            echo '<pre>';
//            print_r($request->input());
//            die;
            $validator = Validator::make($request->all(), [
                        'category' => 'required',
                        'type' => 'required',
                        'limit' => 'required',
                        'payment_gateway' => 'required',
                        'packages' => 'required',
                        'title' => 'required',
                        'fees' => 'required',
                        'starting_date' => 'required',
                        'closing_date' => 'required',
                        'timezone' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            try {
                $user = Auth::user();
                $data = $request->all();
                $existing = Voting_contest::where('title', $data['title'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'VotingContest already exists');
                    return redirect()->back();
                }
                $votingContest = new Voting_contest;
                $votingContest->category = $data['category'];
                $votingContest->type = $data['type'];
                $votingContest->limit = $data['limit'];
                $votingContest->payment_gateway = $data['payment_gateway'];
                $votingContest->packages = $data['packages'];
                $votingContest->title = $data['title'];
                $votingContest->fees = $data['fees'];
                $votingContest->timezone = $data['timezone'];
                $votingContest->starting_date = date("Y-m-d H:i", strtotime($data['starting_date']));
                $votingContest->closing_date = date("Y-m-d H:i", strtotime($data['closing_date']));
                $votingContest->added_by = $user->id;

//                if ($request->hasFile('image_name')) {
//                    if ($request->file('image_name')->isValid()) {
//                        $validated = $request->validate([
//                            'image_name' => 'string|max:40',
//                            'image_name' => 'mimes:jpeg,png|max:1014',
//                        ]);
//                        $file = request()->file('image_name');
//                        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
//                        $file->move('./uploads/images/', $fileName);
//                        $img = '/uploads/images/' . $fileName;
//                        $votingContest->image = $img;
//                    }
//                }
//                print_r('jhfgsadj'); die;
                $votingContest->save();

                if ($votingContest->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'VotingContest Added successfully.');
                    return redirect()->back();
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'VotingContest fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        if ($request->isMethod('get')) {
            return view('admin.votingContests.add');
        }
    }

    public function allvotingContests(Request $request) {
        $allvotingContests = Voting_contest::orderBy('created_at', 'desc')->get();
// echo '<pre>';
// print_r($allvotingContests); die;
        return DataTables::of($allvotingContests)
                        ->addColumn('title', function($allvotingContests) {
                            return $allvotingContests->title;
                        })
                        ->addColumn('image', function($allvotingContests) {
                            $img = '-';
                            if ($allvotingContests->image != '') {
                                $img = '<img src="' . url($allvotingContests->image) . '" width="100" height="100">';
                            }

                            return $img;
                        })
                        ->editColumn('created_at', function($allvotingContests) {
                            if (!empty($allvotingContests->created_at)) {
                                return getDateOnly($allvotingContests->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function($allvotingContests) {
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="' . route('admin.edit.voting', ['id' => $allvotingContests['id']]) . '"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit VotingContest</a>';
                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteVotingContest(this,' . $allvotingContests['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete VotingContest</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['title', 'image', 'created_at', 'action'])
                        ->make(true);
    }

    public function editVotingContest(Request $request) {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'VotingContest_name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            try {
                $data = $request->all();
                $existing = votingContests::where('name', '=', $data['VotingContest_name'])->where('id', '!=', $data['VotingContest_id'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'VotingContest already exists');
                    return redirect()->back();
                }
                $user = Auth::user();

                $VotingContest = votingContests::find($data['VotingContest_id']);
                $VotingContest->name = $data['VotingContest_name'];
                $VotingContest->description = $data['description'];
                $VotingContest->created_by = $user->id;

                if ($request->hasFile('image_name')) {
                    if ($request->file('image_name')->isValid()) {
                        if (file_exists(public_path($data['old_file']))) {
                            unlink(public_path($data['old_file']));
                            File::delete(public_path($data['old_file']));
                        }
                        $validated = $request->validate([
                            'image_name' => 'string|max:40',
                            'image_name' => 'mimes:jpeg,png|max:1014',
                        ]);
                        $file = request()->file('image_name');
                        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                        $file->move('./uploads/images/', $fileName);
                        $img = '/uploads/images/' . $fileName;
                        $VotingContest->image = $img;
                    }
                }
                $VotingContest->update();

                if ($VotingContest->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'VotingContest Updated successfully.');
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
            $VotingContest = votingContests::find($id);
            return view('admin.votingContests.edit')->with('VotingContest', $VotingContest);
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
            $VotingContest = votingContests::find($request->input('id'));
            if (file_exists(public_path($VotingContest->image))) {
                unlink(public_path($VotingContest->image));
                File::delete(public_path($VotingContest->image));
            }
            $VotingContest->delete();

            if ($VotingContest) {
                return Response::json(['success' => true, 'status' => 1, 'message' => "VotingContest has been deleted successfully."]);
            } else {
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}
