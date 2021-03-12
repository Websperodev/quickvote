<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\PricingPlans;

class CategoriesController extends Controller {

    function index(Request $req) {
        $search = '';
        if (!empty($req->input()) && $req->input('cat_name') != '') {
            $name = $req->input('cat_name');
            $search = $name;
            $categories = Categories::where('parent_id', '0')->where('name', 'like', '%' . $name . '%')->get();
        } else {
            $categories = Categories::where('parent_id', '0')->get();
        }
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        $testimonials = Testimonial::all();
        return view('user.categories.list', compact('categories', 'slider', 'search', 'testimonials'));
    }

}
