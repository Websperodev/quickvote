@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | About @endsection
@section("page_title") About @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">About Page</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif
                 {!! Form::open(array('route' => 'admin.pages.about', 'id' => 'add_about_form', 'method' => 'post', 'enctype' => 'multipart/form-data' )) !!}

                    @csrf
                     <div class="top-banner">
                        <label for="about quick">Top Banner</label>
                        <div class="row">
                            <label for="heading">Heading 1</label>
                            <input type="text" class="form-control"  name="banner_heading1" value="{{ isset($data['banner']['heading1']) ? $data['banner']['heading1'] : '' }}" id="banner_heading1" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('banner_heading1'))
                                <div class="error">{{ $errors->first('banner_heading1') }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <label for="heading">Heading 2</label>
                            <input type="text" class="form-control"  name="banner_heading2" value="{{ isset($data['banner']['heading2']) ? $data['banner']['heading2'] : '' }}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('banner_heading2'))
                                <div class="error">{{ $errors->first('banner_heading2') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text">Text</label>
                            <textarea type="text" name="banner_description" id="banner_description" class="form-control" placeholder="Description here..">{{ isset($data['banner']['description']) ? $data['banner']['description'] : '' }}</textarea>
                            @if($errors->has('banner_description'))
                                <div class="error">{{ $errors->first('banner_description') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text">Image</label>
                            @if(isset($data['banner']['img1']) && $data['banner']['img1'] != '' )
                            <img src="{{ url($data['banner']['img1']) }}" width="150" height="150">
                            @endif

                            <input type="file" name="banner_img" id="banner_img" class="form-control" placeholder="Choose Image">
                            @if($errors->has('banner_img'))
                                <div class="error">{{ $errors->first('banner_img') }}</div>
                            @endif
                            <input type="hidden" name="existing_banner_img" value="{{ isset($data['banner']['img1']) ? $data['banner']['img1'] : '' }}">
                        </div>

                    </div> 

                    <div class="about-quick">
                        <label for="about quick">About Quickvote</label>
                        <div class="row">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control"  name="about_heading" value="{{ isset($data['about quickvote']['heading1']) ? $data['about quickvote']['heading1'] : '' }}" id="about_heading" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('about_heading'))
                                <div class="error">{{ $errors->first('about_heading') }}</div>
                            @endif
                         </div>

                        <div class="row">
                            <label for="text">Text</label>
                            <textarea type="text" name="about_description" id="about_description" class="form-control" placeholder="Description here..">{{ isset($data['about quickvote']['description']) ? $data['about quickvote']['description'] : '' }}</textarea>
                            @if($errors->has('about_description'))
                                <div class="error">{{ $errors->first('about_description') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text">Image</label>
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

                    <div class="our_services">
                        <label for="our_services">Our Services</label>
                        <div class="row">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="services_heading" value="{{ isset($data['our services']['heading1']) ? $data['our services']['heading1'] : '' }}" id="services_heading" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('services_heading'))
                                <div class="error">{{ $errors->first('services_heading') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text">Text</label>
                            <textarea type="text" name="services_description" id="services_description" class="form-control" placeholder="Description here..">{{ isset($data['our services']['description']) ? $data['our services']['description'] : '' }}</textarea>
                            @if($errors->has('services_description'))
                                <div class="error">{{ $errors->first('services_description') }}</div>
                            @endif
                        </div>
                    </div>  
                    <div class="btn-right">
                        <a class="btn btn-bg" href="{{ route('services.index',['type' => 'top']) }}"> Add Top Services</a>
                    </div>

                    <div class="dedicated">
                        <label for="dedicated">We are dedicated</label>
                        <div class="row">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="dedicated_heading" value="{{ isset($data['dedicated']['heading1']) ? $data['dedicated']['heading1'] : '' }}" id="dedicated_heading" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('dedicated_heading'))
                                <div class="error">{{ $errors->first('dedicated_heading') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text">Text</label>
                            <textarea type="text" name="dedicated_description" id="dedicated_description" class="form-control" placeholder="Description here..">{{ isset($data['dedicated']['description']) ? $data['dedicated']['description'] : '' }}</textarea>
                            @if($errors->has('dedicated_description'))
                                <div class="error">{{ $errors->first('dedicated_description') }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <label for="text">Image</label>
                            @if(isset($data['dedicated']['img1']) && $data['dedicated']['img1'] != '' )
                            <img src="{{ url($data['dedicated']['img1']) }}" width="150" height="150">
                            @endif

                            <input type="file" name="dedicated_img" id="dedicated_img" class="form-control" placeholder="Choose Image">
                            @if($errors->has('dedicated_img'))
                                <div class="error">{{ $errors->first('dedicated_img') }}</div>
                            @endif
                            <input type="hidden" name="existing_dedicated_img" value="{{ isset($data['dedicated']['img1']) ? $data['dedicated']['img1'] : '' }}">
                        </div>
                    </div>  

                    <div class="news">
                        <label for="news">Our Services</label>
                        <div class="row">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="services_heading2" value="{{ isset($data['our services2']['heading1']) ? $data['our services2']['heading1'] : '' }}" id="services_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('services_heading2'))
                                <div class="error">{{ $errors->first('services_heading2') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text">Text</label>
                            <textarea type="text" name="services_description2" id="services_description2" class="form-control" placeholder="Description here..">{{ isset($data['our services2']['description']) ? $data['our services2']['description'] : '' }}</textarea>
                            @if($errors->has('services_description2'))
                                <div class="error">{{ $errors->first('services_description2') }}</div>
                            @endif
                        </div>
                    </div>  
                    <div class="btn-right">
                        <a class="btn btn-bg" href="{{ route('services.index',['type' => 'bottom']) }}"> Add Bottom Services</a>
                    </div>              

                    <div class="btn-right">
                        <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                    </div>
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
        new nicEditor({ maxHeight : 100 }).panelInstance('banner_description');
        new nicEditor({ maxHeight : 100 }).panelInstance('about_description');
        new nicEditor({ maxHeight : 100 }).panelInstance('services_description');
        new nicEditor({ maxHeight : 100 }).panelInstance('dedicated_description');
        new nicEditor({ maxHeight : 100 }).panelInstance('services_description2');
    });

$('#add_about_form').validate({
    rules:{
        banner_heading1:{
            required:true,
        },
        banner_heading2:{
            required:true,
        },
        banner_description:{
            required:true,
        },
        feature_heading:{
            required:true,
        },
        featured_description:{
            required:true,
        },
        about_heading:{
            required:true,
        },
        services_heading:{
            required:true,
        },
        dedicated_heading:{
            required:true,
        },
        services_heading2:{
            required:true,
        },
        
    },
    messages:{
        banner_heading1:{
          required:"Banner top heading is required",
        },
        banner_heading2:{
          required:"Banner heading is required",
        },
        banner_description:{
          required:"banner text is required",
        },
        feature_heading:{
          required:"Featured heading is required",
        },
        featured_description:{
          required:"Featured Description is required",
        },
        about_heading:{
          required:"About heading is required",
        },
        services_heading:{
          required:"Services heading is required",
        },
        dedicated_heading:{
          required:"Dedicated heading is required",
        },
        services_heading2:{
          required:"Services Heading is required",
        },
        
   }
})
    
   
    
</script>


@endsection