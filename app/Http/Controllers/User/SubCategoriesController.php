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

class SubCategoriesController extends Controller {

    function index(Request $req) {

        $search = '';
        if (!empty($req->input()) && $req->input('scat_name') != '') {
            $name = $req->input('scat_name');
            $search = $name;
            $subcategories = Categories::select('categories.*')
                    ->rightjoin('voting_contests', 'voting_contests.category_id', '=', 'categories.id')
                    ->where('voting_contests.status', 'Accepted')
                    ->where('categories.parent_id', '!=', '0')
                    ->where('categories.name', 'like', '%' . $name . '%')
                    ->groupBy('categories.id')
                    ->get();
        } else {
            $subcategories = Categories::select('categories.*')
                            ->rightjoin('voting_contests', 'voting_contests.category_id', '=', 'categories.id')
                            ->where('voting_contests.status', 'Accepted')
                            ->where('categories.parent_id', '!=', '0')
                            ->groupBy('categories.id')->get();
        }
//        echo '<pre>';
//        print_r($subcategories); die;
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        $testimonials = Testimonial::all();
        return view('user.subcategories.list', compact('subcategories', 'slider', 'search', 'testimonials'));
    }

}
