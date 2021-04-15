<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;
use Response;
use App\User;
use App\Models\Categories;
use Yajra\Datatables\Datatables;

class CategoriesController extends Controller {

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
        return view('admin.categories.index');
    }

    public function addCategory(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'category_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            try {

                $user = Auth::user();
                $data = $request->all();
                $existing = Categories::where('name', $data['category_name'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Category already exists');
                    return redirect()->back();
                }
                $category = new Categories;
                $category->name = $data['category_name'];
                $category->description = $data['description'];
                $category->created_by = $user->id;

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
                        $category->image = $img;
                    }
                }
                $category->save();

                if ($category->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'Category Added successfully.');
                    return redirect()->back();
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Category fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        if ($request->isMethod('get')) {
            return view('admin.categories.add');
        }
    }

    public function allCategories(Request $request) {
        $allCategories = Categories::orderBy('created_at', 'desc')->get();

        return DataTables::of($allCategories)
                        ->addColumn('name', function ($allCategories) {
                            return $allCategories->name;
                        })
                        ->addColumn('image', function ($allCategories) {
                            $img = '-';
                            if ($allCategories->image != '') {
                                $img = '<img src="' . url($allCategories->image) . '" width="100" height="100">';
                            }

                            return $img;
                        })
                        ->editColumn('created_at', function ($allCategories) {
                            if (!empty($allCategories->created_at)) {
                                return getDateOnly($allCategories->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function ($allCategories) {
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="' . route('admin.edit-category', ['id' => $allCategories['id']]) . '"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Category</a>';
                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteCategory(this,' . $allCategories['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Category</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['name', 'image', 'created_at', 'action'])
                        ->make(true);
    }

    public function editCategory(Request $request) {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'category_name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            try {
                $data = $request->all();
                $existing = Categories::where('name', '=', $data['category_name'])->where('id', '!=', $data['category_id'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Category already exists');
                    return redirect()->back();
                }
                $user = Auth::user();

                $category = Categories::find($data['category_id']);
                $category->name = $data['category_name'];
                $category->description = $data['description'];
                $category->created_by = $user->id;

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
                        $category->image = $img;
                    }
                }
                $category->update();

                if ($category->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'Category Updated successfully.');
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
            $category = Categories::find($id);
            return view('admin.categories.edit')->with('category', $category);
        }
    }

    public function deleteCategory(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'status' => 2, "error" => $validator->errors()->first()]);
        }
        try {
            $category = Categories::find($request->input('id'));
            if (file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
                File::delete(public_path($category->image));
            }
            $category->delete();

            if ($category) {
                return Response::json(['success' => true, 'status' => 1, 'message' => "Category has been deleted successfully."]);
            } else {
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}
