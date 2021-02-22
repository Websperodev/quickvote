<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Countries;
use App\Models\TeamMember;
use App\Models\Categories;
use App\Models\Testimonial;
use App\Models\PricingPlans;
use DB;

class UserController extends Controller {

    public function index() {
        $countries = Countries::get();
        $pageData = [];
        $sliders = [];
        $data = Page::where('page_name', 'home')->get();
        if ($data->count() > 0) {
            foreach ($data as $val) {
                $pageData[$val->section] = $val;
            }
        }
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        $testimonials = Testimonial::all();
        if ($slider->count() > 0) {
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }
        $pricingData = PricingPlans::get();

        return view('user.pages.homepage', compact('countries', 'pageData', 'pricingData', 'sliders', 'testimonials'));
    }

    public function getAbout() {
        $countries = Countries::get();
        $pageArray = ['home', 'aboutus'];
        $data = Page::whereIn('page_name', $pageArray)->get();
        $pageData = [];
        $sliders = [];
        $services = [];
        $banners = [];

        if ($data->count() > 0) {
            foreach ($data as $val) {
                $pageData[$val->page_name][$val->section] = $val;
            }
        }
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
        return view('user.pages.aboutus', compact('countries', 'pageData', 'sliders', 'testimonials', 'services', 'banners'));
    }

    public function getPricing() {
        $countries = Countries::get();
        $pageArray = ['home', 'aboutus'];

        $pricingData = PricingPlans::get();
        // dd($pageData);

        $testimonials = Testimonial::all();
        $inArray = ['trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        if ($slider->count() > 0) {
            $sliders = [];
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }
        $allServices = Service::get();
        $services = [];
        if ($allServices->count() > 0) {
            foreach ($allServices as $val) {
                $services[$val->type][] = $val;
            }
        }
        $banners = [];
        $aboutBanner = Banner::where('page', 'pricing')->first();
        if (!empty($aboutBanner)) {
            $banners = $aboutBanner;
        }


        return view('user.pages.pricing', compact('countries', 'pricingData', 'sliders', 'testimonials', 'services', 'banners'));
    }

    public function getContact() {
        $countries = Countries::get();
        $pageArray = ['home', 'aboutus'];
        $data = Page::whereIn('page_name', $pageArray)->get();
        if ($data->count() > 0) {
            $pageData = [];
            foreach ($data as $val) {
                $pageData[$val->page_name][$val->section] = $val;
            }
        }
        $testimonials = Testimonial::all();
        $inArray = ['trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        if ($slider->count() > 0) {
            $sliders = [];
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }
        $allServices = Service::get();
        $services = [];
        if ($allServices->count() > 0) {
            foreach ($allServices as $val) {
                $services[$val->type][] = $val;
            }
        }
        $banners = [];
        $aboutBanner = Banner::where('page', 'contact')->first();
        if (!empty($aboutBanner)) {
            $banners = $aboutBanner;
        }
        return view('user.pages.contact', compact('countries', 'pageData', 'sliders', 'testimonials', 'services', 'banners'));
    }

    public function getFaq() {
        $faqs = Faq::orderBy('id', 'desc')->limit('10')->get();
        $countries = Countries::get();
        $banners = [];
        $faqBanner = Banner::where('page', 'faq')->first();
        if (!empty($faqBanner)) {
            $banners = $faqBanner;
        }
        return view('user.pages.faq', compact('countries', 'faqs', 'banners'));
    }

    public function openServices() {
        $countries = Countries::get();
        $banners = [];
        $sliders = [];
        $servicesBanner = Banner::where('page', 'services')->first();
        if (!empty($servicesBanner)) {
            $banners = $servicesBanner;
        }
        $services = Service::orderBy('id', 'desc')->limit('10')->get();
        $inArray = ['trusted brands'];

        $slider = Slider::whereIn('name', $inArray)->get();
        if ($slider->count() > 0) {
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }
        $testimonials = Testimonial::all();
        $pageData = [];
        $serviceData = Page::where(['page_name' => 'aboutus', 'section' => 'Our Services'])->first();
        $data = Page::where(['page_name' => 'home', 'section' => 'testimonial'])->first();
        if (!empty($data)) {
            $pageData['testimonial'] = $data;
        }

        return view('user.pages.services', compact('countries', 'pageData', 'sliders', 'serviceData', 'services', 'banners', 'testimonials'));
    }

    public function openTeam() {
        $countries = Countries::get();
        $banners = [];
        $sliders = [];
        $pageData = [];

        $servicesBanner = Banner::where('page', 'our-team')->first();
        if (!empty($servicesBanner)) {
            $banners = $servicesBanner;
        }
        $services = Service::orderBy('id', 'desc')->limit('10')->get();
        $inArray = ['trusted brands'];

        $slider = Slider::whereIn('name', $inArray)->get();
        if ($slider->count() > 0) {
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }
        $data = Page::whereIn('page_name', ['our-team', 'our-investors'])->get();
        if ($data->count() > 0) {
            foreach ($data as $val) {
                $pageData[$val->section] = $val;
            }
        }
        $testimonials = Testimonial::all();
        $teamMember = TeamMember::all();

        return view('user.pages.our-team', compact('countries', 'sliders', 'pageData', 'testimonials', 'services', 'banners', 'teamMember'));
    }

    public function openSearch(Request $req) {
        $countries = Countries::get();
        $banners = [];
        $sliders = [];
        $pageData = [];
        $data = Page::whereIn('page_name', ['our-team', 'our-investors'])->get();
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        if ($req->input()) {
            if ($req->input('eventname') && $req->input('eventname') != '') {
                $eventname = $req->input('eventname');
            } else {
                $eventname = '';
            }
            if ($req->input('date') && $req->input('date') != '') {
                $eventDate = $req->input('date');
            } else {
                $eventDate = '';
            }
        } else {
            $eventname = '';
            $eventDate = '';
        }
//        if ($req->input()) {
//            if ($req->input('eventname') != '' && $req->input('date') == '') {
//                $allEvents = Event::where('name', 'like', '%' . $req->input('eventname') . '%')->where('start_date', '>', $date)->orderBy('id', 'desc')->paginate(2);
//            } elseif ($req->input('date') != '' && $req->input('eventname') == '') {
//                $allEvents = Event::where('start_date', '>', $req->input('date'))->orderBy('id', 'desc')->paginate(2);
//            } elseif ($req->input('eventname') != '' && $req->input('date') != '') {
//                $allEvents = Event::where('start_date', '>', $req->input('date'))->where('name', 'like', '%' . $req->input('eventname') . '%')->orderBy('id', 'desc')->paginate(2);
//            } else {
//                $allEvents = Event::where('start_date', '>', $date)->orderBy('id', 'desc')->get();
//            }
//        } else {
//            $allEvents = Event::where('start_date', '>', $date)->orderBy('id', 'desc')->paginate(2);
//        }
//        if ($req->ajax()) {
//            return view('user.pages.eventAjax', compact('allEvents'));
//        }
        $servicesBanner = Banner::where('page', 'our-team')->first();
        if (!empty($servicesBanner)) {
            $banners = $servicesBanner;
        }
        $services = Service::orderBy('id', 'desc')->limit('10')->get();
        $inArray = ['trusted brands'];

        $slider = Slider::whereIn('name', $inArray)->get();
        if ($slider->count() > 0) {
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }

        if ($data->count() > 0) {
            foreach ($data as $val) {
                $pageData[$val->section] = $val;
            }
        }
        $testimonials = Testimonial::all();
        $teamMember = TeamMember::all();
        $allCategories = Categories::all();




        return view('user.pages.event', compact('countries', 'sliders', 'pageData', 'testimonials', 'services', 'banners', 'teamMember', 'allCategories', 'eventname', 'eventDate'));
    }

//    function fetch_data(Request $request) {
//         $mytime = Carbon::now();
//        $date = $mytime->toDateString();
//        if ($request->ajax()) {
//            $allEvents = Event::where('start_date', '>', $date)->orderBy('id', 'desc')->paginate(2);
//           
//            return view('user.pages.eventAjax', compact('allEvents'))->render();
//        }
//    }
//    function fetch_data(Request $request) {
//        $mytime = Carbon::now();
//        $date = $mytime->toDateString();
//        $allEvents = [];
////        echo '<pre>';
////        print_r($request->input());
////        die;
//
//        if ($request->ajax()) {
//            if ($request->input()) {
//                $name = $request->input('keyname');
//                $cat = $request->input('category');
//                $eventDate = $request->input('eventdate');
//                $tabfillter = $request->input('tabfillter');
//                $allEvents = Event::where('end_date', '>', $date)
//                                ->where(function($allEvents) use ($eventDate, $request) {
//                                    if ($eventDate != "") {
//                                        $allEvents->where('end_date', '>', $eventDate);
//                                    }
//                                })
//                                ->where(function($allEvents) use ($name, $request) {
//                                    if ($name != "") {
//                                        $allEvents->where('name', 'like', '%' . $name . '%');
//                                    }
//                                })
//                                ->where(function($allEvents) use ($cat, $request) {
//                                    if ($cat != "") {
//                                        $allEvents->where('category_id', $cat);
//                                    }
//                                })
//                                ->where(function($allEvents) use ($tabfillter, $request) {
//                                    switch ($tabfillter) {
//                                        CASE 'all':
//                                            break;
//                                    }
//                                })
//                                ->get()->toArray();
//                if (!empty($allEvents)) {
//                    foreach ($allEvents as $key => $event) {
//                        $allEvents[$key]['tickets'] = DB::table('tickets')->where(['event_id' => $event['id']])->get()->toArray();
//                    }
//                }
////                echo '<pre>';
////                print_r($allEvents); die;
//                return json_encode($allEvents);
//            } else {
//
//                $allEvents = Event::where('end_date', '>', $date)->orderBy('id', 'desc')->get()->toArray();
//            }
//        }
//        return json_encode($allEvents);
//    }

}
