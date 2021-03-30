<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\States;
use Auth;
use Session;
use Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class stateController extends Controller {

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
        return view('admin.states.index');
    }

    public function addstate(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'country_id' => 'required',
//                        'country_code' => 'required|alpha||min:2|max:2',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
//            print_r($request->input()); die;
            try {

                $user = Auth::user();
                $data = $request->all();
                $existing = states::where('name', $data['name'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'State already exists');
                    return redirect()->back();
                }
                $state = new States;
                $state->name = ucfirst($data['name']);
                $state->country_id = $data['country_id'];
//                $state->country_code = strtoupper($data['country_code']);

//                $state->created_by = $user->id;


                $state->save();

                if ($state->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'State added successfully.');
                    return redirect()->back();
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'state fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        if ($request->isMethod('get')) {
            $countries = Countries::get();
            return view('admin.states.add', compact('countries'));
        }
    }

    public function allstates(Request $request) {
        $allstates = States::with('counties')->orderBy('created_at', 'desc')->get();
//        echo '<pre>';
//        print_r($allstates);
//        die;
        return DataTables::of($allstates)
                        ->addColumn('name', function($allstates) {
                            return $allstates->name;
                        })
                        ->addColumn('counties', function($allstates) {
                            if ($allstates->counties != '') {
                                return $allstates->counties->name;
                            }
                        })                     
                        ->editColumn('created_at', function($allstates) {
                            if (!empty($allstates->created_at)) {
                                return getDateOnly($allstates->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function($allstates) {
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="' . route('admin.edit.state', ['id' => $allstates['id']]) . '"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit state</a>';
                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deletestate(this,' . $allstates['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete state</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['name', 'counties', 'country_code', 'created_at', 'action'])
                        ->make(true);
    }

    public function editstate(Request $request) {

        if ($request->isMethod('post')) {
//             echo '<pre>';
//                print_r($request->input('post')); die;
            $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'country_id' => 'required',
//                        'country_code' => 'required|alpha||min:2|max:2',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            try {
                $data = $request->all();
                $existing = States::where('name', '=', $data['name'])->where('id', '!=', $data['state_id'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'State already exists');
                    return redirect()->back();
                }


                $user = Auth::user();
                $state = new States;
                $state = $state::find($data['state_id']);
                $state->name = ucfirst($data['name']);
                $state->country_id = $data['country_id'];
//                $state->country_code = strtoupper($data['country_code']);
                $state->update();
                if ($state->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'State updated successfully.');
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
            $state = States::find($id);
            $countries = Countries::get();
            return view('admin.states.edit', compact('state', 'countries'));
        }
    }

    public function deletestate(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'status' => 2, "error" => $validator->errors()->first()]);
        }
        try {
            $state = States::find($request->input('id'));

            $state->delete();

            if ($state) {
                return Response::json(['success' => true, 'status' => 1, 'message' => "state has been deleted successfully."]);
            } else {
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}
