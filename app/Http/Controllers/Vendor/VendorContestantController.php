<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Response;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Models\Event;
use App\Models\Contestant;
use Session;
use Auth;

class VendorContestantController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('vendor.contestant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $events = Event::where('start_date', '>', $date)->get();
//        echo '<pre>';
//        print_r($events); die;
        return view('vendor.contestant.add', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//        echo '<pre>';
//print_r($request->input()); die;
        $event_id = $request->get('event_id');
        $name = $request->get('name');
        $number = $request->get('number');
        $about = $request->get('about');
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $key => $image) {
                $fileName = md5($image->getClientOriginalName() . time()) . "." . $image->getClientOriginalExtension();
                $image->move('./uploads/images/', $fileName);
                $img = 'uploads/images/' . $fileName;

                $contestant = new Contestant;
                $contestant->event_id = $event_id;
                $contestant->name = $name[$key];
                $contestant->phone = $number[$key];
                $contestant->image = $img;
                $contestant->about = $about[$key];
                $contestant->added_by = $user['id'];
                $contestant->save();
            }
        }
        if ($contestant->id != '') {
            return Response::json(['success' => true, 'status' => 1, 'message' => 'Contestant added Successfully ']);
        }
    }

    public function getContestant(Request $request) {
        $user = Auth::user();
        $allContestant = Contestant::where(['added_by' => $user['id']])->orderBy('created_at', 'desc')->get();
        return DataTables::of($allContestant)
                        ->addColumn('image', function($allContestant) {
                            $img = '<img src="' . url($allContestant->image) . '" width="100" height="100">';
                            return $img;
                        })
                        ->addColumn('name', function($allContestant) {
                            return $allContestant->name;
                        })
                        ->addColumn('contact', function($allContestant) {
                            return $allContestant->phone;
                        })
                        ->addColumn('about', function($allContestant) {
                            return $allContestant->about;
                        })
                        ->editColumn('created_at', function($allContestant) {
                            if (!empty($allContestant->created_at)) {
                                return getDateOnly($allContestant->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function($allContestant) {
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

}
