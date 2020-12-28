<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Countries;
use App\Models\Testimonial;


class UserController extends Controller
{
   
    public function index()
    {  
    	//echo '<pre>';
        $countries = Countries::get();
        $data = Page::where('page_name', 'home')->get();
        if($data->count() > 0){
            $pageData = [];
            foreach($data as $val){
                $pageData[$val->section] = $val;
            }
                
        }
        $inArray = ['home','trusted brands'];
        $slider = Slider::whereIn('name',$inArray)->get();
        $testimonials = Testimonial::all();
        if($slider->count() > 0){
            $sliders = [];
            foreach($slider as $val){
                $sliders[$val->name][] = $val;
            }       
        }
        return view('user.pages.homepage', compact('countries', 'pageData', 'sliders', 'testimonials'));
    }
    public function getAbout(){
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
        if($allServices->count() > 0){
            $services = [];
            foreach($allServices as $val){
                $services[$val->type][] = $val;
            }       
        }
        
        return view('user.pages.aboutus', compact('countries','pageData' ,'sliders', 'testimonials', 'services'));
    }
}
