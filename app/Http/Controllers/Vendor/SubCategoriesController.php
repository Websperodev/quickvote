<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Categories;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Page;


class SubCategoriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('vendor.subcategories.index');
    }

    public function allsubcategories(Request $request) {
        $allsubcategories = Subcategory::orderBy('created_at', 'desc')->get();

        return DataTables::of($allsubcategories)
                        ->addColumn('name', function($allsubcategories) {
                            return $allsubcategories->name;
                        })
                        ->addColumn('image', function($allsubcategories) {
                            $img = '-';
                            if ($allsubcategories->image != '') {
                                $img = '<img src="' . url($allsubcategories->image) . '" width="100" height="100">';
                            }

                            return $img;
                        })
                        ->editColumn('created_at', function($allsubcategories) {
                            if (!empty($allsubcategories->created_at)) {
                                return getDateOnly($allsubcategories->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function($allsubcategories) {
                            if (Auth::user()->id == $allsubcategories['created_by']) {
                                $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item" href="' . route('subcategories.edit', $allsubcategories->id) . '"  ><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Category</a>';

                                $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteSubCategory(this,' . $allsubcategories->id . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Category</a>';
                                $str .= '</div></div>';
                                return $str;
                            } else {
                                return '-';
                            }
                        })
                        ->rawColumns(['name', 'image', 'created_at', 'action'])
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Categories::get();
        return view('vendor.subcategories.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//echo '<pre>';
//print_r($request->all()); die;
        try {
            $validator = Validator::make($request->all(), [
                        'category_id' => 'required',
                        'name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            try {
                $user = Auth::user();
                $data = $request->all();
                $existing = Subcategory::where('name', $data['name'])->count();
//                echo '<pre>';
//                print_r($existing); die;
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Subcsategory already exists');
                    return redirect()->back();
                }

                $subcategory = new Subcategory;
                $subcategory->category_id = $data['category_id'];
                $subcategory->name = $data['name'];
                $subcategory->description = $data['description'];
                $subcategory->created_by = $user->id;

                if ($request->hasFile('image_name')) {
                    if ($request->file('image_name')->isValid()) {
                        $validated = $request->validate([
                            'image_name' => 'string|max:40',
                            'image_name' => 'mimes:jpeg,png|max:1014',
                        ]);
                        $file = request()->file('image_name');
                        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                        $file->move('./uploads/images/', $fileName);
                        $img = '/uploads/images/' . $fileName;
                        $subcategory->image = $img;
                    }
                }
//                echo '<pre>';
//print_r($request->all()); die;
                $subcategory->save();

                if ($subcategory->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'Subcategory Added successfully.');
                    return redirect()->back();
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Subcategory fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        } catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
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
     * @param  int  $iddeleteCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $subcategory = Subcategory::find($id);
        $categories = Categories::get();
        return view('vendor.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'category_id' => 'required',
                    'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $data = $request->all();
            $existing = Subcategory::where('name', '=', $data['name'])->where('id', '!=', $data['id'])->count();
            if ($existing > 0) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', 'Subcategory already exists');
                return redirect()->back();
            }
            $user = Auth::user();

            $subcategory = Subcategory::find($data['id']);
            $subcategory->category_id = $data['category_id'];
            $subcategory->name = $data['name'];
            $subcategory->description = $data['description'];
            $subcategory->created_by = $user->id;
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
                    $subcategory->image = $img;
                }
            }
            $subcategory->update();

            if ($subcategory->id != '') {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Subcategory Updated successfully.');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $subcategory = Subcategory::findOrFail($id);
            $subcategory->delete();

            if ($subcategory) {
                return Response::json(['success' => true, 'status' => 1, 'message' => "Subcategory has been deleted successfully."]);
            } else {
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}
