<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Response;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Models\Event;
use App\Models\Contestant;
use Auth;
use App\Models\Votingcontest;

class ContestantController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index() {
        return view('admin.contestant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $votingcontest = Votingcontest::where('closing_date', '>', $date)->get();
        return view('admin.contestant.add', compact('votingcontest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $voting_id = $request->get('voting_id');
        $name = $request->get('name');
        $number = $request->get('number');
        $about = $request->get('about');
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $key => $image) {
                $row = Contestant::select('candidate_id')->latest('id')->first();
//                print_r($row); die;
                if (empty($row)) {
                    $candidate_id = 1;
                } else {
                    $candidate_id = $row->candidate_id + 1;
                }
                $fileName = md5($image->getClientOriginalName() . time()) . "." . $image->getClientOriginalExtension();
                $image->move('./uploads/images/', $fileName);
                $img = 'uploads/images/' . $fileName;
                $contestant = new Contestant;
                $contestant->voting_id = $voting_id;
                $contestant->name = $name[$key];
                $contestant->phone = $number[$key];
                $contestant->candidate_id = $candidate_id;
                $contestant->image = $img;
                $contestant->about = $about[$key];
                $contestant->added_by = $user['id'];
                $contestant->save();
            }
        }
        if ($contestant->id != '') {
            return Response::json(['success' => true, 'status' => 1, 'message' => 'Contestant added Successfully ']);
        } else {
            return Response::json(['error' => true, 'status' => 0, 'message' => 'All feild are required']);
        }
    }

    public function getContestant(Request $request) {
        $allContestant = Contestant::orderBy('created_at', 'desc')->get();

        return DataTables::of($allContestant)
                        ->addColumn('image', function ($allContestant) {
                            $img = '<img src="' . url($allContestant->image) . '" width="100" height="100">';
                            return $img;
                        })
                        ->addColumn('name', function ($allContestant) {
                            return $allContestant->name;
                        })
                        ->addColumn('voting_id', function ($allContestant) {
                            return votingName($allContestant->voting_id);
                        })
                        ->addColumn('contact', function ($allContestant) {
                            return $allContestant->phone;
                        })
                        ->addColumn('about', function ($allContestant) {
                            return $allContestant->about;
                        })
                        ->editColumn('created_at', function ($allContestant) {
                            if (!empty($allContestant->created_at)) {
                                return getDateOnly($allContestant->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function ($allContestant) {
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" data-name="' . $allContestant->name . '" data-image="' . $allContestant->image . '" data-phone="' . $allContestant->phone . '" data-about="' . $allContestant->about . '" onclick="editcontestant(this,' . $allContestant->id . ')"   class="dropdown-item"  ><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-m
                iddle"></i> Edit Contestant</a>';

                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteContestant(this,' . $allContestant->id . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Contestant</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['image', 'name', 'contact', 'about', 'created_at', 'action'])
                        ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $name = $request->get('name');
        $phone = $request->get('number');
        $about = $request->get('about');
        $error = [];
        if ($name == '') {
            $error['name'] = 'Name field is required';
        }
        if ($about == '') {
            $error['about'] = 'About field is required';
        }
        if ($phone == '') {
            $error['number'] = 'Number field is required';
        } else {
            if (!preg_match('/^[0-9]+$/', $phone)) {
                $error['number'] = 'Please enter valid number';
            }
        }

//        $validator = Validator::make($request->all(), [
//                    'name' => 'required',
//                    'number' => 'required',
//        ]);
//        if ($validator->fails()) {
//            return Response::json(['success' => false, 'status' => 1, 'error' => 'Please fill required fields']);
//        }

        if (!empty($error)) {
            $err = json_encode($error);
            return Response::json(['success' => false, 'status' => 3, 'inputvalidation' => $error]);
        }

        try {

            $contestant = Contestant::find($id);
            $contestant->name = $request->get('name');
            $contestant->phone = $request->get('number');
            $contestant->about = $request->get('about');
            if ($request->hasFile('image')) {

                if (file_exists(public_path($request->get('existing_image')))) {
                    unlink(public_path($request->get('existing_image')));
                    File::delete(public_path($request->get('existing_image')));
                }

                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/images/', $fileName);
                $img = 'uploads/images/' . $fileName;
                $contestant->image = $img;
            }
            $contestant->save();

            return Response::json(['success' => true, 'status' => 1, 'message' => 'Contestant updated Successfully ']);
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, 'error' => 'Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $contestant = Contestant::findOrFail($id);
            $contestant->delete();

            if ($contestant) {
                return Response::json(['success' => true, 'status' => 1, 'message' => "Contestant has been deleted successfully."]);
            } else {
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}
