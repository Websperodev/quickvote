<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries;
use Auth;
use Session;
use Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller {

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
        return view('admin.countries.index');
    }

    public function addCountry(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'phonecode' => 'required|regex:/^\+\d{1,3}$/',
                        'currency' => 'required|alpha||min:3|max:3',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
//            print_r($request->input()); die;
            try {

                $user = Auth::user();
                $data = $request->all();
                $existing = countries::where('name', $data['name'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Country already exists');
                    return redirect()->back();
                }
                $Country = new countries;
                $Country->name = $data['name'];
                $Country->phonecode = $data['phonecode'];
                $Country->currency = strtoupper($data['currency']);
                $Country->created_by = $user->id;


                $Country->save();

                if ($Country->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'Country Added successfully.');
                    return redirect()->back();
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Country fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        if ($request->isMethod('get')) {
            return view('admin.countries.add');
        }
    }

    public function allcountries(Request $request) {
        $allcountries = Countries::orderBy('created_at', 'desc')->get();

        return DataTables::of($allcountries)
                        ->addColumn('name', function($allcountries) {
                            return $allcountries->name;
                        })
                        ->addColumn('phonecode', function($allcountries) {
                            if ($allcountries->phonecode != '') {
                               return $allcountries->phonecode;
                            }
                        })
                        ->addColumn('currency', function($allcountries) {
                            if ($allcountries->currency != '') {
                               return $allcountries->currency;
                            }
                        })
                        ->editColumn('created_at', function($allcountries) {
                            if (!empty($allcountries->created_at)) {
                                return getDateOnly($allcountries->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function($allcountries) {
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="' . route('admin.edit.country', ['id' => $allcountries['id']]) . '"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Country</a>';
                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteCountry(this,' . $allcountries['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Country</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['name', 'phonecode', 'currency', 'created_at', 'action'])
                        ->make(true);
    }

    public function editCountry(Request $request) {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'phonecode' => 'required|regex:/^\+\d{1,3}$/',
                        'currency' => 'required|alpha||min:3|max:3',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            try {
                $data = $request->all();
                $existing = countries::where('name', '=', $data['name'])->where('id', '!=', $data['country_id'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Country already exists');
                    return redirect()->back();
                }
                $user = Auth::user();

                $Country = new countries;
                $Country = $Country::find($data['country_id']);
                $Country->name = $data['name'];
                $Country->phonecode = $data['phonecode'];
                $Country->currency = strtoupper($data['currency']);
                $Country->update();
                if ($Country->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'Country Updated successfully.');
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
            $country = countries::find($id);
            return view('admin.countries.edit')->with('country', $country);
        }
    }

    public function deleteCountry(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'status' => 2, "error" => $validator->errors()->first()]);
        }
        try {
            $Country = countries::find($request->input('id'));
         
            $Country->delete();

            if ($Country) {
                return Response::json(['success' => true, 'status' => 1, 'message' => "Country has been deleted successfully."]);
            } else {
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}
