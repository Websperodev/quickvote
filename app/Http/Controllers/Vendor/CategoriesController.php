<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Page;
use App\Models\ModulesList;
use App\Models\VendorPermissions;
use Response;

class CategoriesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:vendor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        $permissions = VendorPermissions::where(['vendor_id' => $user->id, 'modul_id' => 2])->first();
//        echo '<pre>';
//        print_r($permissions); die;
        return view('vendor.categories.index', compact('permissions'));
    }

    public function allcategories(Request $request) {
        $uId = Auth::user()->id;
//        $allcategories = Categories::where('created_by', $uId)->orWhere('parent_id',0)->orderBy('created_at', 'desc')->get();
        $allcategories = Categories::with('parent')->orderBy('created_at', 'desc')->get();
//        $allcategories = Categories::select(DB::raw('(CASE WHEN users.id = ' . $user . ' THEN 1 ELSE 0 END) AS is_user')
//                )->where('created_by', $uId)->orWhere('parent_id', 0)->orderBy('created_at', 'desc')->get();
//echo '<pre>';
//        print_r($allcategories[0]->parent->name); die;
        return DataTables::of($allcategories)
                        ->addColumn('name', function ($allcategories) {
                            return $allcategories->name;
                        })
                        ->addColumn('parent_id', function ($allcategories) {
                            if ($allcategories->parent_id != 0) {
                                return $allcategories->parent->name;
                            } else {
                                return '-';
                            }
                        })
                        ->addColumn('image', function ($allcategories) {
                            $img = '-';
                            if ($allcategories->image != '') {
                                $img = '<img src="' . url($allcategories->image) . '" width="100" height="100">';
                            }
                            return $img;
                        })
                        ->editColumn('created_at', function ($allcategories) {
                            if (!empty($allcategories->created_at)) {
                                return getDateOnly($allcategories->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function ($allcategories) {
                            if ($allcategories->parent_id != '0' && Auth::user()->id == $allcategories['created_by']) {
                                $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item" href="' . route('vendor-categories.edit', $allcategories->id) . '"  ><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Category</a>';

                                $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteSubCategory(this,' . $allcategories->id . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Category</a>';
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
    public function create(Request $request) {
        $user = Auth::user();
        $permissions = VendorPermissions::where(['vendor_id' => $user->id, 'modul_id' => 2])->first();
        if ($permissions->add == '1') {
            $categories = Categories::where('parent_id', 0)->get();
            return view('vendor.categories.add', compact('categories'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', 'You have no added permission.');
            return redirect()->back();
        }
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
                $existing = Categories::where('name', $data['name'])->where('parent_id', '!=', '0')->count();
//                echo '<pre>';
//                print_r($existing); die;
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Subcsategory already exists');
                    return redirect()->back();
                }

                $subcategory = new Categories;
                $subcategory->parent_id = $data['category_id'];
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
        $subcategory = Categories::find($id);
        $categories = Categories::where('parent_id', 0)->get();
        return view('vendor.categories.edit', compact('subcategory', 'categories'));
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
//            echo '<pre>';
//            print_r($data); die;
            $existing = Categories::where('name', '=', $data['name'])->where('id', '!=', $data['id'])->count();
            if ($existing > 0) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', 'Category already exists');
                return redirect()->back();
            }
            $user = Auth::user();

            $subcategory = Categories::find($data['id']);
            $subcategory->parent_id = $data['category_id'];
            $subcategory->name = $data['name'];
            $subcategory->description = $data['description'];
            $subcategory->created_by = $user->id;
            if ($request->hasFile('image_name')) {
                if ($request->file('image_name')->isValid()) {
                    if ($data['old_file'] != '' && file_exists(public_path($data['old_file']))) {
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
            $subcategory = Categories::findOrFail($id);
            $subcategory->delete();         
                return Response::json(['success' => true, 'status' => 1, 'message' => "Subcategory has been deleted successfully."]);           
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}
