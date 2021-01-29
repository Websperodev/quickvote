@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Page | Home @endsection
@section("page_title") Home @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Home Page</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif
                 {!! Form::open(array('route' => 'admin.pages.home', 'id' => 'add_home_form', 'class' => 'custum-frm','method' => 'post', 'enctype' => 'multipart/form-data' )) !!}

                    @csrf
                    <div class="featured-event mb-2">
                        <label for="featured event" class="col-12">Featured Event </label>
                        <div class="row">
                            <label for="heading">Heading <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control"  name="feature_heading" value="{{ isset($data['featured event']['heading1']) ? $data['featured event']['heading1'] : '' }}" id="feature_heading" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('feature_heading'))
                                <div class="error">{{ $errors->first('feature_heading') }}</div>
                            @endif
                         </div>

                        <div class="row">
                            <label for="text" class="col-12">Text <span class='required_field required_red'>*</span></label>
                            <textarea type="text" name="featured_description" id="featured_description" class="form-control" placeholder="Description here..">{{ isset($data['featured event']['description']) ? $data['featured event']['description'] : ''}}</textarea>
                            @if($errors->has('featured_description'))
                                <div class="error">{{ $errors->first('featured_description') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="about-quick mb-2">
                        <label for="about quick" class="col-12">About Quickvote</label>
                        <div class="row">
                            <label for="heading" class="col-12">Heading <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control"  name="about_heading" value="{{ isset($data['about quickvote']['heading1']) ? $data['about quickvote']['heading1'] : '' }}" id="about_heading" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('about_heading'))
                                <div class="error">{{ $errors->first('about_heading') }}</div>
                            @endif
                         </div>

                        <div class="row">
                            <label for="text" class="col-12">Text <span class='required_field required_red'>*</span></label>
                            <textarea type="text" name="about_description" id="about_description" class="form-control" placeholder="Description here..">{{ isset($data['about quickvote']['description']) ? $data['about quickvote']['description'] : '' }}</textarea>
                            @if($errors->has('about_description'))
                                <div class="error">{{ $errors->first('about_description') }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <label for="text" class="col-12">Image <span class='required_field required_red'>*</span></label>
                            @if(isset($data['about quickvote']['img1']) && $data['about quickvote']['img1'] != '' )
                            <img src="{{ url($data['about quickvote']['img1']) }}" width="150" height="150">
                            @endif

                            <input type="file" name="about_img" id="about_img" class="form-control" placeholder="Choose Image">
                            @if($errors->has('about_img'))
                                <div class="error">{{ $errors->first('about_img') }}</div>
                            @endif
                            <input type="hidden" name="existing_about_img" value="{{ isset($data['about quickvote']['img1']) ? $data['about quickvote']['img1'] : '' }}">
                        </div>

                    </div>  

                    <div class="our_pricing mb-2">
                        <label for="our pricing" class="col-12">Our Pricing</label>
                        <div class="row">
                            <label for="heading" class="col-12">Heading <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control" name="pricing_heading" value="{{ isset($data['our pricing']['heading1']) ? $data['our pricing']['heading1'] : '' }}" id="pricing_heading" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('pricing_heading'))
                                <div class="error">{{ $errors->first('pricing_heading') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text" class="col-12">Text <span class='required_field required_red'>*</span></label>
                            <textarea type="text" name="pricing_description" id="pricing_description" class="form-control" placeholder="Description here..">{{ isset($data['our pricing']['description']) ? $data['our pricing']['description'] : '' }}</textarea>
                            @if($errors->has('pricing_description'))
                                <div class="error">{{ $errors->first('pricing_description') }}</div>
                            @endif
                        </div>
                    </div>  

                    <div class="testiminials mb-2">
                        <label for="testimonials" class="col-12">Testimonials</label>
                        <div class="row">
                            <label for="heading" class="col-12">Heading <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control" name="testimonial_heading" value="{{ isset($data['testimonial']['heading1']) ? $data['testimonial']['heading1'] : '' }}" id="testimonial_heading" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('testimonial_heading'))
                                <div class="error">{{ $errors->first('testimonial_heading') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text" class="col-12">Text <span class='required_field required_red'>*</span></label>
                            <textarea type="text" name="testimonial_description" id="testimonial_description" class="form-control" placeholder="Description here..">{{ isset($data['testimonial']['description']) ? $data['testimonial']['description'] : '' }}</textarea>
                            @if($errors->has('testimonial_description'))
                                <div class="error">{{ $errors->first('testimonial_description') }}</div>
                            @endif
                        </div>
                    </div>  

                    <div class="news mb-2">
                        <label for="news" class="col-12">News and Update</label>
                        <div class="row">
                            <label for="heading" class="col-12">Heading <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control" name="news_heading" value="{{ isset($data['news and update']['heading1']) ? $data['news and update']['heading1'] : '' }}" id="news_heading" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('news_heading'))
                                <div class="error">{{ $errors->first('news_heading') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text" class="col-12">Text <span class='required_field required_red'>*</span></label>
                            <textarea type="text" name="news_description" id="news_description" class="form-control" placeholder="Description here..">{{ isset($data['news and update']['description']) ? $data['news and update']['description'] : '' }}</textarea>
                            @if($errors->has('news_description'))
                                <div class="error">{{ $errors->first('news_description') }}</div>
                            @endif
                        </div>
                    </div>                

                    <div class="trusted-brands mb-2">
                        <label for="trusted-brands" class="col-12">Trusted Brands</label>
                        <div class="row">
                            <label for="heading" class="col-12">Heading <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control" name="trusted_heading" value="{{ isset($data['news and update']['heading1']) ? $data['news and update']['heading1'] : '' }}" id="trusted_heading" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('trusted_heading'))
                                <div class="error">{{ $errors->first('trusted_heading') }}</div>
                            @endif
                        </div>
                    </div> 

                    
                        <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                   
                {!! Form::close() !!}

            </div> <!-- end card-body-->
        </div> 
    </div>
</div> 
@endsection



@section('script-bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/nicEdit-latest.js') }}"></script>
<script type="text/javascript">

bkLib.onDomLoaded(function() {
    new nicEditor({ maxHeight : 100 }).panelInstance('featured_description');
    new nicEditor({ maxHeight : 100 }).panelInstance('about_description');
    new nicEditor({ maxHeight : 100 }).panelInstance('pricing_description');
    new nicEditor({ maxHeight : 100 }).panelInstance('testimonial_description');
    new nicEditor({ maxHeight : 100 }).panelInstance('news_description');
});

$('#add_home_form').validate({
    rules:{
        feature_heading:{
            required:true,
        },
        featured_description:{
            required:true,
        },
        about_heading:{
            required:true,
        },
        about_description:{
            required:true,
        },
        pricing_heading:{
            required:true,
        },
        pricing_description:{
            required:true,
        },
        testimonial_heading:{
            required:true,
        },
        testimonial_description:{
            required:true,
        },
        news_heading:{
            required:true,
        },
        news_description:{
            required:true,
        },
        trusted_heading:{
            required:true,
        },
    },
    messages:{
        feature_heading:{
          required:"Featured heading is required",
        },
        featured_description:{
          required:"Featured Description is required",
        },
        about_heading:{
          required:"About heading is required",
        },
        about_description:{
          required:"About description is required",
        },
        pricing_heading:{
          required:"Pricing heading is required",
        },
        pricing_description:{
          required:"Pricing description is required",
        },
        testimonial_heading:{
          required:"Testimonial heading is required",
        },
        testimonial_description:{
          required:"Testimonial description is required",
        },
        news_heading:{
          required:"News heading is required",
        },
        news_description:{
          required:"News description is required",
        },
        trusted_heading:{
          required:"Trusted heading is required",
        },
   }
})
    
   
    
</script>


@endsection