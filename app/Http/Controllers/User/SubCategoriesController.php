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
use Carbon\Carbon;
use App\Models\Categories;
use Yajra\Datatables\Datatables;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\PricingPlans;
use App\Models\Service;
use App\Models\Banner;

class SubCategoriesController extends Controller {

    function index(Request $req) {

        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $search = '';
        $testimonials = [];

        if ($req->input() && $req->input('scat_name') != '') {

            $name = $req->input('scat_name');
            $search = $name;
            $subcategories = Categories::select('categories.*')
                    ->rightjoin('voting_contests', 'voting_contests.category_id', '=', 'categories.id')
                    ->where('voting_contests.status', 'Accepted')
                    ->where('categories.parent_id', '!=', '0')
                    ->where('categories.name', 'like', '%' . $name . '%')
                    ->where('voting_contests.closing_date', '>', $date)
                    ->groupBy('categories.id')
                    ->get();
        } else {

            $subcategories = Categories::select('categories.*')
                            ->rightjoin('voting_contests', 'voting_contests.category_id', '=', 'categories.id')
                            ->where('voting_contests.status', 'Accepted')
                            ->where('categories.parent_id', '!=', '0')
                            ->where('voting_contests.closing_date', '>', $date)
                            ->groupBy('categories.id')->get();
        }
//        echo '<pre>';
//        print_r($subcategories); die;
        $testimonials = Testimonial::all();
        $inArray = ['trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        if ($slider->count() > 0) {
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }
        $allServices = Service::get();
        if ($allServices->count() > 0) {
            foreach ($allServices as $val) {
                $services[$val->type][] = $val;
            }
        }

        $aboutBanner = Banner::where('page', 'aboutus')->first();
        if (!empty($aboutBanner)) {
            $banners = $aboutBanner;
        }
        return view('user.subcategories.list', compact('subcategories', 'search', 'sliders', 'testimonials', 'services', 'banners'));
    }

}
