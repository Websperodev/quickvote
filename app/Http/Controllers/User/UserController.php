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

class UserController extends Controller
{
   
    public function index()
    {  
        $countries = Countries::get();
        $pageData = [];
        $sliders = [];
        $data = Page::where('page_name', 'home')->get();
        if($data->count() > 0){
            foreach($data as $val){
                $pageData[$val->section] = $val;
            }
                
        }
        $inArray = ['home','trusted brands'];
        $slider = Slider::whereIn('name',$inArray)->get();
        $testimonials = Testimonial::all();
        if($slider->count() > 0){
            foreach($slider as $val){
                $sliders[$val->name][] = $val;
            }       
        }
        $pricingData = PricingPlans::get();

        return view('user.pages.homepage', compact('countries', 'pageData', 'pricingData', 'sliders', 'testimonials'));
    }
    public function getAbout(){
    	$countries = Countries::get();
    	$pageArray = ['home','aboutus'];
    	$data = Page::whereIn('page_name', $pageArray)->get();
        $pageData = [];
        $sliders = [];
        $services = [];
        $banners = [];

        if($data->count() > 0){
            foreach($data as $val){
                $pageData[$val->page_name][$val->section] = $val;
            }     
        }
    	$testimonials = Testimonial::all();
    	$inArray = ['trusted brands'];
        $slider = Slider::whereIn('name',$inArray)->get();
        if($slider->count() > 0){
            foreach($slider as $val){
                $sliders[$val->name][] = $val;
            }       
        }
        $allServices = Service::get();
        if($allServices->count() > 0){
            foreach($allServices as $val){
                $services[$val->type][] = $val;
            }       
        }

        $aboutBanner = Banner::where('page', 'aboutus')->first();
        if(!empty($aboutBanner)){
            $banners = $aboutBanner;
        }
        return view('user.pages.aboutus', compact('countries','pageData' ,'sliders', 'testimonials', 'services','banners'));
    }

    public function getPricing(){
        $countries = Countries::get();
        $pageArray = ['home','aboutus'];

        $pricingData = PricingPlans::get();
        // dd($pageData);

        $testimonials = Testimonial::all();
        $inArray = ['trusted brands'];
        $slider = Slider::whereIn('name',$inArray)->get();
        if($slider->count() > 0){
            $sliders = [];
            foreach($slider as $val){
                $sliders[$val->name][] = $val;
            }       
        }
        $allServices = Service::get();
        $services = [];
        if($allServices->count() > 0){
            foreach($allServices as $val){
                $services[$val->type][] = $val;
            }       
        }
        $banners = [];
        $aboutBanner = Banner::where('page', 'pricing')->first();
        if(!empty($aboutBanner)){
            $banners = $aboutBanner;
        }


        return view('user.pages.pricing', compact('countries','pricingData' ,'sliders', 'testimonials', 'services', 'banners'));

    }

    public function getContact(){
        $countries = Countries::get();
        $pageArray = ['home','aboutus'];
        $data = Page::whereIn('page_name', $pageArray)->get();
        if($data->count() > 0){
            $pageData = [];
            foreach($data as $val){
                $pageData[$val->page_name][$val->section] = $val;
            }     
        }
        $testimonials = Testimonial::all();
        $inArray = ['trusted brands'];
        $slider = Slider::whereIn('name',$inArray)->get();
        if($slider->count() > 0){
            $sliders = [];
            foreach($slider as $val){
                $sliders[$val->name][] = $val;
            }       
        }
        $allServices = Service::get();
        $services = [];
        if($allServices->count() > 0){
            foreach($allServices as $val){
                $services[$val->type][] = $val;
            }       
        }
        $banners = [];
        $aboutBanner = Banner::where('page', 'contact')->first();
        if(!empty($aboutBanner)){
            $banners = $aboutBanner;
        }
        return view('user.pages.contact', compact('countries','pageData' ,'sliders', 'testimonials', 'services','banners'));
    }
    public function getFaq(){
        $faqs = Faq::orderBy('id','desc')->limit('10')->get();
        $countries = Countries::get();
        $banners = [];
        $faqBanner = Banner::where('page', 'faq')->first();
        if(!empty($faqBanner)){
            $banners = $faqBanner;
        }
        return view('user.pages.faq', compact('countries', 'faqs','banners'));
    }
    public function openServices(){
        $countries = Countries::get();
        $banners = [];
        $sliders = [];
        $servicesBanner = Banner::where('page', 'services')->first();
        if(!empty($servicesBanner)){
            $banners = $servicesBanner;
        }
        $services = Service::orderBy('id','desc')->limit('10')->get();
        $inArray = ['trusted brands'];

        $slider = Slider::whereIn('name',$inArray)->get();
        if($slider->count() > 0){
            foreach($slider as $val){
                $sliders[$val->name][] = $val;
            }       
        }
        $testimonials = Testimonial::all();
        $pageData = [];
        $serviceData = Page::where(['page_name' => 'aboutus', 'section' => 'Our Services'])->first();
        $data = Page::where(['page_name' => 'home', 'section' => 'testimonial'])->first();
        if(!empty($data)){
            $pageData['testimonial'] = $data; 
        }
        
        return view('user.pages.services', compact('countries', 'pageData', 'sliders','serviceData' ,'services','banners','testimonials'));

    }
    public function openTeam(){
        $countries = Countries::get();
        $banners = [];
        $sliders = [];
        $pageData = [];

        $servicesBanner = Banner::where('page', 'our-team')->first();
        if(!empty($servicesBanner)){
            $banners = $servicesBanner;
        }
        $services = Service::orderBy('id','desc')->limit('10')->get();
        $inArray = ['trusted brands'];

        $slider = Slider::whereIn('name',$inArray)->get();
        if($slider->count() > 0){
            foreach($slider as $val){
                $sliders[$val->name][] = $val;
            }       
        }
        $data = Page::whereIn('page_name', ['our-team','our-investors'])->get();
        if($data->count() > 0){
            foreach($data as $val){
                $pageData[$val->section] = $val;
            }
                
        }
        $testimonials = Testimonial::all();
        $teamMember = TeamMember::all();
        
        return view('user.pages.our-team', compact('countries','sliders','pageData','testimonials' ,'services','banners', 'teamMember'));
    }

    public function openSearch(){
        $countries = Countries::get();
        $banners = [];
        $sliders = [];
        $pageData = [];

        $servicesBanner = Banner::where('page', 'our-team')->first();
        if(!empty($servicesBanner)){
            $banners = $servicesBanner;
        }
        $services = Service::orderBy('id','desc')->limit('10')->get();
        $inArray = ['trusted brands'];

        $slider = Slider::whereIn('name',$inArray)->get();
        if($slider->count() > 0){
            foreach($slider as $val){
                $sliders[$val->name][] = $val;
            }       
        }
        $data = Page::whereIn('page_name', ['our-team','our-investors'])->get();
        if($data->count() > 0){
            foreach($data as $val){
                $pageData[$val->section] = $val;
            }
                
        }
        $testimonials = Testimonial::all();
        $teamMember = TeamMember::all();
        $allCategories = Categories::all();

        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $allEvents = Event::where('start_date','>',$date)->orderBy('id','desc')->get();
       
        return view('user.pages.event', compact('countries','sliders','pageData','testimonials' ,'services','banners', 'teamMember', 'allCategories' , 'allEvents'));

    }








}
