<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use App\Models\Page;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\PricingPlans;

use Yajra\Datatables\Datatables;
use Response;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPage(Request $request)
    {   
        $page = $request->name;

        if($page == 'home'){
            $page = Page::where('page_name','home')->get();
            if($page->count() > 0){
                $data = [];
                foreach($page as $val){
                    $data[$val->section] = $val;
                }
                return view('admin.pages.home')->with('data',$data);
            }else{
                return view('admin.pages.home');
            }  
        }
        if($page == 'about'){ 
            $page = Page::where('page_name','aboutus')->get();
            if($page->count() > 0){
                $data = [];
                foreach($page as $val){
                    $data[$val->section] = $val;
                }
                return view('admin.pages.about')->with('data',$data);
            }else{
                return view('admin.pages.about');
            }
        }
        if($page == 'testimonials'){
            return redirect()->route('testimonials.index');
        }
        if($page == 'pricing'){ 
            $page = PricingPlans::get();
            $data = [];
            
            if($page->count() > 0){
                foreach($page as $key => $value){
                    $newK = $key+1;
                    $data['page_heading'] = $value['page_heading'];
                    $data['description'] =  $value['description'];
                    $planType = "planType".$newK;
                    $planAmount = 'planAmount'.$newK;
                    $planHeading = 'planHeading'.$newK;
                    $planFeatures = 'planFeatures'.$newK;
                    $planButtonText = 'planButtonText'.$newK;
                    $data[$planType] = $value['plan_type'];
                    $data[$planAmount] =  $value['plan_amount'];
                    $data[$planHeading] =  $value['plan_heading'];
                    $data[$planFeatures] =  $value['plan_features'];
                    $data[$planButtonText] =  $value['button_text'];                    
                    $data['page_heading'] = $value['page_heading'];
                    $data['description'] =  $value['description'];

                }
                return view('admin.pages.pricing')->with('data',$data);
            }else{
                return view('admin.pages.pricing');
            }
        }
        if($page == 'contact'){ 
            $page = Page::where('page_name','contact')->get();
            if($page->count() > 0){
                $data = [];
                foreach($page as $val){
                    $data[$val->section] = $val;
                }
                return view('admin.pages.contact')->with('data',$data);
            }else{
                return view('admin.pages.contact');
            }
        }

        
        
    }

    public function getSlider(Request $request)
    {   
        $slider =  $request->name;
        if($slider == 'home'){
            return view('admin.sliders.home.index');
        }

        if($slider == 'trusted_brands'){
            return view('admin.sliders.trusted_brands.index');
        }
        
    }

    public function addHomePage(Request $request){
        $validator = Validator::make($request->all(), [
                                        'feature_heading'          => 'required',
                                        'featured_description'     => 'required',
                                        'about_heading'            => 'required',
                                        'about_description'        => 'required',
                                        'pricing_heading'          => 'required',
                                        'pricing_description'      => 'required',
                                        'testimonial_heading'      => 'required',
                                        'testimonial_description'  => 'required',
                                        'news_heading'             => 'required',
                                        'news_description'         => 'required',
                                        'trusted_heading'          => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{

            $page = Page::where('page_name','home')->count();
            $msg = 'Data inserted successfully';

            if($page > 0){
                Page::where('page_name','home')->delete();
                $msg = 'Data updated successfully';
            }

            $page = new Page; 
            $page->page_name = 'home';
            $page->section = 'featured event';
            $page->heading1 = $request->get('feature_heading');
            $page->description   = $request->get('featured_description');
            $page->save();

            $page = new Page; 
            $page->page_name = 'home';
            $page->section = 'about quickvote';
            $page->heading1 = $request->get('about_heading');
            $page->description   = $request->get('about_description');
            $page->save();
            if ($request->hasFile('about_img')) {
                if(file_exists(public_path($request->get('existing_about_img')))){
                    unlink(public_path($request->get('existing_about_img')));
                    File::delete(public_path($request->get('existing_about_img')));

                }
                if ($request->file('about_img')->isValid()) {
                    $validated = $request->validate([
                        'about_img' => 'string|max:40',
                        'about_img' => 'mimes:jpeg,png|max:1014',
                    ]);
                    $file = request()->file('about_img');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $page->img1 =  $img;
                    $page->update();
                }
            }

            $page = new Page; 
            $page->page_name = 'home';
            $page->section = 'our pricing';
            $page->heading1 = $request->get('pricing_heading');
            $page->description   = $request->get('pricing_description');
            $page->save();

            $page = new Page; 
            $page->page_name = 'home';
            $page->section = 'testimonial';
            $page->heading1 = $request->get('testimonial_heading');
            $page->description   = $request->get('testimonial_description');
            $page->save();

            $page = new Page; 
            $page->page_name = 'home';
            $page->section = 'news and update';
            $page->heading1 = $request->get('news_heading');
            $page->description   = $request->get('news_description');
            $page->save();

            $page = new Page; 
            $page->page_name = 'home';
            $page->section = 'trusted brands';
            $page->heading1 = $request->get('trusted_heading');
            $page->save();

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }


    }

    public function addAboutPage(Request $request){
        $validator = Validator::make($request->all(), [
                                        'about_heading'          => 'required',
                                        'about_description'      => 'required',
                                        'services_heading'       => 'required',
                                        'services_description'   => 'required',
                                        'dedicated_heading'      => 'required',
                                        'dedicated_description'  => 'required',
                                        'services_heading2'      => 'required',
                                        'services_description2'  => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        try{

            $page = Page::where('page_name','aboutus')->count();
            $msg = 'Data inserted successfully';

            if($page > 0){
                Page::where('page_name','aboutus')->delete();
                $msg = 'Data updated successfully';
            }

           
            $page = new Page; 
            $page->page_name = 'aboutus';
            $page->section = 'about quickvote';
            $page->heading1 = $request->get('about_heading');
            $page->description   = $request->get('about_description');
            
            if ($request->hasFile('about_img')) {

                if($request->get('existing_about_img') != ''){
                    if(file_exists(public_path($request->get('existing_about_img')))){
                        unlink(public_path($request->get('existing_about_img')));
                        File::delete(public_path($request->get('existing_about_img')));
                    }
                }
                
                if ($request->file('about_img')->isValid()) {
                    $validated = $request->validate([
                        'about_img' => 'string|max:40',
                        'about_img' => 'mimes:jpeg,png|max:1014',
                    ]);
                    $file = request()->file('about_img');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $page->img1 =  $img;
                    
                }
            }
            $page->save();

            $page = new Page; 
            $page->page_name = 'aboutus';
            $page->section = 'our services';
            $page->heading1 = $request->get('services_heading');
            $page->description   = $request->get('services_description');
            $page->save();

            $page = new Page; 
            $page->page_name = 'aboutus';
            $page->section = 'dedicated';
            $page->heading1 = $request->get('dedicated_heading');
            $page->description   = $request->get('dedicated_description');
            
            if ($request->hasFile('dedicated_img')) {
                if($request->get('existing_dedicated_img') != ''){
                    if(file_exists(public_path($request->get('existing_dedicated_img')))){
                        unlink(public_path($request->get('existing_dedicated_img')));
                        File::delete(public_path($request->get('existing_dedicated_img')));
                    }
                }

                if ($request->file('dedicated_img')->isValid()) {
                    $validated = $request->validate([
                        'dedicated_img' => 'string|max:40',
                        'dedicated_img' => 'mimes:jpeg,png|max:1014',
                    ]);
                    $file = request()->file('dedicated_img');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $page->img1 =  $img;
                    
                }
            }
            $page->save();

            $page = new Page; 
            $page->page_name = 'aboutus';
            $page->section = 'our services2';
            $page->heading1 = $request->get('services_heading2');
            $page->description   = $request->get('services_description2');
            $page->save();

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }


    }

    public function addHomeSlider(Request $request){
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'image'         => 'required',
                'heading1'      => 'required',
                'heading2'      => 'required',
                'description'   => 'required',

            ]);

            if ($validator->fails())
            {  
                return redirect()->back()->withErrors($validator);
            }
            try{

            $slider = new Slider;
            $slider->name = 'home';
            $slider->heading1 = $request->get('heading1');
            $slider->heading2 = $request->get('heading2');
            $slider->description = $request->get('description');
            $slider->save();

            if ($request->hasFile('image')) {    
                if ($request->file('image')->isValid()) {
                    $validated = $request->validate([
                        'image' => 'string|max:40',
                        'image' => 'mimes:jpeg,png|max:1014',
                    ]);
                    $file = request()->file('image');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $slider->img1 =  $img;
                    $slider->update();
                }
            }
            
            if($slider->id != ''){
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Image Added successfully.');
                return redirect()->back();
            }else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', 'fail.');
                return redirect()->back();
            }
            }catch(\Exception $e){
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back();

            }

        }
        if($request->isMethod('get')){
            return view('admin.sliders.home.add');
        }

    }

    public function allHomeSlider(Request $request){
        $slider = Slider::where('name','home')->orderBy('created_at','desc')->get();
       
        return DataTables::of($slider)
            ->addColumn('heading1',function($slider) {
                return $slider->heading1;
            })
            ->addColumn('heading2',function($slider) {
                return $slider->heading2;
            })    
            ->addColumn('image',function($slider) {
                $img = '-';
                if($slider->img1 != ''){
                    $img = '<img src="'. url($slider->img1) .'" width="100" height="100">';
                }
                
                return $img;
            })    
            ->editColumn('created_at',function($slider) {
                if(!empty($slider->created_at)) {
                    return getDateOnly($slider->created_at);
                }
                return 'N/A';
            })
           ->addColumn('action',function($slider) {
                $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="'.route('admin.edit.homeSlider',['id'=>$slider['id']]).'"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Image</a>';

                
                $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteSlider(this,'.$slider['id'].')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Image</a>';
                $str .= '</div></div>';
                return $str;
            }) 
            ->rawColumns(['heading1','heading2','image','created_at', 'action'])
            ->make(true);         
    }

    public function editHomeSlider(Request $request){
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'image'   => 'required',
                'heading1'   => 'required',
                'heading2'   => 'required',
                'description'   => 'required',

            ]);

            if ($validator->fails())
            {  
                return redirect()->back()->withErrors($validator);
            }
            try{

            $slider = Slider::find($request->get('id'));
            $slider->heading1 = $request->get('heading1');
            $slider->heading2 = $request->get('heading2');
            $slider->description = $request->get('description');
            $slider->update();

            if ($request->hasFile('image')) {    
                if ($request->file('image')->isValid()) {
                    $validated = $request->validate([
                        'image' => 'string|max:40',
                        'image' => 'mimes:jpeg,png|max:1014',
                    ]);
                    if(file_exists(public_path($request->get('existing_img')))){
                        unlink(public_path($request->get('existing_img')));
                        File::delete(public_path($request->get('existing_img')));
                    }
                    $file = request()->file('image');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $slider->img1 =  $img;
                    $slider->update();
                }
            }
            
            if($slider->id != ''){
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Image Added successfully.');
                return redirect()->back();
            }else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', 'fail.');
                return redirect()->back();
            }
            }catch(\Exception $e){
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back();

            }

        }
        if($request->isMethod('get')){
            $id = $request->get('id');
            $slider = Slider::find($id);
            return view('admin.sliders.home.edit')->with('slider', $slider);
        }

    }

    public function deleteHomeSlider(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'status' => 2, "error" => $validator->errors()->first()]);
        }
        try{
            $slider = Slider::find($request->input('id'));
            if(file_exists(public_path($slider->img1))){
                unlink(public_path($slider->img1));
                File::delete(public_path($slider->img1));
            }
            $slider->delete();
           
            if($slider){
                return Response::json(['success' => true, 'status' => 1, 'message' => "Image has been deleted successfully."]);
            }else{
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        }catch(\Exception $e){
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        } 

    }
    public function addTrustedSlider(Request $request){
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'image'   => 'required',
            ]);

            if ($validator->fails())
            {  
                return redirect()->back()->withErrors($validator);
            }
            try{

            $slider = new Slider;
            $slider->name = 'trusted brands';
            $slider->save();

            if ($request->hasFile('image')) {    
                if ($request->file('image')->isValid()) {
                    $validated = $request->validate([
                        'image' => 'string|max:40',
                        'image' => 'mimes:jpeg,png|max:1014',
                    ]);
                    $file = request()->file('image');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $slider->img1 =  $img;
                    $slider->update();
                }
            }
            
            if($slider->id != ''){
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Image Added successfully.');
                return redirect()->back();
            }else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', 'fail.');
                return redirect()->back();
            }
            }catch(\Exception $e){
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back();

            }

        }
        if($request->isMethod('get')){
            return view('admin.sliders.trusted_brands.add');
        }

    }

    public function allTrustedBrandsSlider(Request $request){

        $slider = Slider::where('name','trusted brands')->orderBy('created_at','desc')->get();
       
        return DataTables::of($slider)   
            ->addColumn('image',function($slider) {
                $img = '-';
                if($slider->img1 != ''){
                    $img = '<img src="'. url($slider->img1) .'" width="100" height="100">';
                }
                
                return $img;
            })    
            ->editColumn('created_at',function($slider) {
                if(!empty($slider->created_at)) {
                    return getDateOnly($slider->created_at);
                }
                return 'N/A';
            })
           ->addColumn('action',function($slider) {
                $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="'.route('admin.edit.trustedBrandsSlider',['id'=>$slider['id']]).'"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Image</a>';

                
                $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteSlider(this,'.$slider['id'].')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Image</a>';
                $str .= '</div></div>';
                return $str;
            }) 
            ->rawColumns(['image','created_at', 'action'])
            ->make(true);         

    }
    public function editTrustedBrandsSlider(Request $request){

        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'image'   => 'required',
                'image' => 'mimes:jpeg,png|max:1014',
            ]);

            if ($validator->fails())
            {  
                return redirect()->back()->withErrors($validator);
            }
            try{

            $slider = Slider::find($request->get('id'));
            if ($request->hasFile('image')) {    
                if ($request->file('image')->isValid()) {
                    $validated = $request->validate([
                        'image' => 'string|max:40',
                        'image' => 'mimes:jpeg,png|max:1014',
                    ]);
                    if(file_exists(public_path($request->get('existing_img')))){
                        unlink(public_path($request->get('existing_img')));
                        File::delete(public_path($request->get('existing_img')));
                    }
                    $file = request()->file('image');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $slider->img1 =  $img;
                    $slider->update();
                }
            }
            
            if($slider->id != ''){
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Image Added successfully.');
                return redirect()->back();
            }else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', 'fail.');
                return redirect()->back();
            }
            }catch(\Exception $e){
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back();

            }

        }
        if($request->isMethod('get')){
            $id = $request->get('id');
            $slider = Slider::find($id);
            return view('admin.sliders.trusted_brands.edit')->with('slider', $slider);
        }

    }

    public function addContactPage(Request $request){
        $validator = Validator::make($request->all(), [
                                        'banner_heading1'     => 'required',
                                        'banner_heading2'     => 'required',
                                        'banner_img'          => 'required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }

        try{

            $page = Page::where('page_name','contact')->count();
            $msg = 'Data inserted successfully';

            if($page > 0){
                Page::where('page_name','contact')->delete();
                $msg = 'Data updated successfully';
            }

            $page = new Page; 
            $page->page_name = 'contact';
            $page->section = 'banner';
            $page->heading1 = $request->get('banner_heading1');
            $page->heading2 = $request->get('banner_heading2');
            $page->save();

            if ($request->hasFile('banner_img')) {
                if($request->get('existing_banner_img') != ''){
                    if(file_exists(public_path($request->get('existing_banner_img')))){
                        unlink(public_path($request->get('existing_banner_img')));
                        File::delete(public_path($request->get('existing_banner_img')));
                    }
                }
                if ($request->file('banner_img')->isValid()) {
                    $validated = $request->validate([
                        'banner_img' => 'string|max:40',
                        'banner_img' => 'mimes:jpeg,png|max:1014',
                    ]);
                    $file = request()->file('banner_img');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $page->img1 =  $img;
                    $page->update();
                }
            }
            
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }

    }
    public function addPricingPage(Request $request){
        
        $validator = Validator::make($request->all(), [
                                        'page_heading'     => 'required',
                                        'page_text'        => 'required'
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }

        try{
                        
            $page = PricingPlans::count();
            $msg = 'Data inserted successfully';

            if($page > 0){
                PricingPlans::truncate();
                $msg = 'Data updated successfully';
            }

            $planType = $request->get('plan_type');
            $planAmount = $request->get('plan_amount');
            $planHeading = $request->get('plan_heading');
            $features = $request->get('features');
            $buttonText = $request->get('button_text');
            $pageHeading = $request->get('page_heading');
            $pageText = $request->get('page_text');

            
            foreach($planType as $key => $value){
                $pricingPlans = new PricingPlans();
                $pricingPlans->plan_type = $planType[$key];
                $pricingPlans->plan_amount = $planAmount[$key];
                $pricingPlans->plan_heading = $planHeading[$key];
                $pricingPlans->plan_features = $features[$key];
                $pricingPlans->button_text = $buttonText[$key];
                $pricingPlans->page_heading = $pageHeading;
                $pricingPlans->description = $pageText;
                $pricingPlans->button_text = $buttonText[$key];
                $pricingPlans->save();
            }
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', $msg);
            return redirect()->back();
        }catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    public function getBanners(Request $request){
        $banner =  $request->name;

        $page = Banner::where('page',$banner)->get();
        $data = [];
        if($page->count() > 0){
            $data = $page[0]; 
        }
        
        if( $banner == 'aboutus'){
            return view('admin.banners.aboutus')->with('data',$data);;
        }
        if( $banner == 'contact'){
            return view('admin.banners.contact')->with('data',$data);;
        }
        if( $banner == 'pricing'){
            return view('admin.banners.pricing')->with('data',$data);;
        }
        if( $banner == 'faq'){
            return view('admin.banners.faq')->with('data',$data);;
        }
        if( $banner == 'services'){
            return view('admin.banners.services')->with('data',$data);;
        }
        if( $banner == 'our-team'){
            return view('admin.banners.our-team')->with('data',$data);;
        }

    }

    public function addBanner(Request $request){

        $validator = Validator::make($request->all(), [
                                        'banner_heading1'     => 'required',
                                        'banner_heading2'     => 'required',
                                        'banner_description'  => 'required',
                                        'banner_img'          => 'sometimes|required',
                                    ]);

        if ($validator->fails())
        {  
            return redirect()->back()->withErrors($validator);
        }
        
        $existingBanner = Banner::where('page', $request->get('banner'))->get();
        $msg = 'Data inserted successfully';
        
        if($existingBanner->count() > 0){
            $msg = 'Data updated successfully';
            $banner = Banner::find($existingBanner[0]['id']);
            $banner->heading1 = $request->get('banner_heading1');
            $banner->heading2 = $request->get('banner_heading2');
            $banner->description = $request->get('banner_description');
            $banner->update();

            if ($request->hasFile('banner_img')) {
                if($request->get('existing_banner_img') != ''){
                    if(file_exists(public_path($request->get('existing_banner_img')))){
                        unlink(public_path($request->get('existing_banner_img')));
                        File::delete(public_path($request->get('existing_banner_img')));
                    }
                }  
                if ($request->file('banner_img')->isValid()) {
                    $validated = $request->validate([
                        'banner_img' => 'string|max:40',
                        'banner_img' => 'mimes:jpeg,png|max:1014',
                    ]);
                    $file = request()->file('banner_img');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $banner->img =  $img;
                    $banner->update();
                }
            }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', $msg);
            return redirect()->back();
        }else{
            $banner = new Banner();
            $banner->page = $request->get('banner');
            $banner->heading1 = $request->get('banner_heading1');
            $banner->heading2 = $request->get('banner_heading2');
            $banner->description = $request->get('banner_description');
            $banner->save();

            if ($request->hasFile('banner_img')) {
                if ($request->file('banner_img')->isValid()) {
                    $validated = $request->validate([
                        'banner_img' => 'string|max:40',
                        'banner_img' => 'mimes:jpeg,png|max:1014',
                    ]);
                    $file = request()->file('banner_img');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('./uploads/images/', $fileName); 
                    $img = '/uploads/images/'.$fileName;
                    $banner->img =  $img;
                    $banner->update();
                }
            }
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', $msg);
            return redirect()->back();
        }
        
    }




}
