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

class CategoriesController extends Controller {

    function index(Request $req) {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $search = '';
        if (!empty($req->input()) && $req->input('cat_name') != '') {
            $name = $req->input('cat_name');
            $search = $name;
            $categories = Categories::select('categories.*')
                    ->rightjoin('events', 'events.category_id', '=', 'categories.id')
                    ->where('events.status', 'Accepted')
                    ->where('categories.parent_id', '0')
                    ->where('categories.name', 'like', '%' . $name . '%')
                    ->where('events.end_date', '>', $date)
                    ->groupBy('categories.id')
                    ->get();
        } else {
            $categories = Categories::select('categories.*')
                    ->rightjoin('events', 'events.category_id', '=', 'categories.id')
                    ->where('events.status', 'Accepted')
                    ->where('categories.parent_id', '0')
                    ->where('events.end_date', '>', $date)
                    ->groupBy('categories.id')
                    ->get();
        }
        $inArray = ['Categories', 'trusted brands'];
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
        $testimonials = Testimonial::all();
        $aboutBanner = Banner::where('page', 'aboutus')->first();
        if (!empty($aboutBanner)) {
            $banners = $aboutBanner;
        }
        return view('user.categories.list', compact('categories', 'sliders', 'search', 'testimonials', 'services', 'banners'));
    }

}
