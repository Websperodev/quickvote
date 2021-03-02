<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use Auth;
use Session;
use Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CitiesController extends Controller {

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
        return view('admin.cities.index');
    }

    public function addCity(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'state_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
//            print_r($request->input()); die;
            try {

                $user = Auth::user();
                $data = $request->all();
                $existing = Cities::where('name', $data['name'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'City already exists');
                    return redirect()->back();
                }
                $City = new cities;
                $City->name = ucfirst($data['name']);
                $City->state_id = $data['state_id'];



                $City->save();

                if ($City->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'City Added successfully.');
                    return redirect()->back();
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'City fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        if ($request->isMethod('get')) {
            $states = States::get();
            return view('admin.cities.add', compact('states'));
        }
    }

    public function allcities(Request $request) {
        $allcities = Cities::with('states')->orderBy('created_at', 'desc')->get();
//        echo '<pre>';
//        print_r($allcities);
//        die;
        return DataTables::of($allcities)
                        ->addColumn('name', function($allcities) {
                            return $allcities->name;
                        })
                        ->addColumn('states', function($allcities) {
                            if ($allcities->states != '') {
                                return $allcities->states->name;
                            }
                        })
                        ->editColumn('created_at', function($allcities) {
                            if (!empty($allcities->created_at)) {
                                return getDateOnly($allcities->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function($allcities) {
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="' . route('admin.edit.city', ['id' => $allcities['id']]) . '"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit City</a>';
                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteCity(this,' . $allcities['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete City</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['name', 'states', 'created_at', 'action'])
                        ->make(true);
    }

    public function editCity(Request $request) {

        if ($request->isMethod('post')) {
//             echo '<pre>';
//                print_r($request->input('post')); die;
            $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'state_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            try {
                $data = $request->all();
                $existing = Cities::where('name', '=', $data['name'])->where('id', '!=', $data['city_id'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'City already exists');
                    return redirect()->back();
                }


                $user = Auth::user();
                $City = new Cities;
                $City = $City::find($data['city_id']);
                $City->name = ucfirst($data['name']);
                $City->state_id = $data['state_id'];

                $City->update();
                if ($City->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'City Updated successfully.');
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
            $city = Cities::find($id);
            $states = States::get();
            return view('admin.cities.edit', compact('city', 'states'));
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

}
