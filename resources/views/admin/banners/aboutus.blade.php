@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | About Banner @endsection
@section("page_title") About @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">About Page Banner</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif
                 {!! Form::open(array('route' => 'admin.banner', 'id' => 'add_banner_form','class' => 'custum-frm', 'method' => 'post', 'enctype' => 'multipart/form-data' )) !!}

                    @csrf
                     <div class="top-banner">
                        <label for="about quick" class="col-12">Top Banner</label>
                        <div class="row">
                            <label for="heading" class="col-12">Heading 1 <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control"  name="banner_heading1" value="{{ isset($data['heading1']) ? $data['heading1'] : '' }}" id="banner_heading1" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('banner_heading1'))
                                <div class="error">{{ $errors->first('banner_heading1') }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <label for="heading" class="col-12">Heading 2 <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control"  name="banner_heading2" value="{{ isset($data['heading2']) ? $data['heading2'] : '' }}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                            @if($errors->has('banner_heading2'))
                                <div class="error">{{ $errors->first('banner_heading2') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text" class="col-12">Text <span class='required_field required_red'>*</span></label>
                            <textarea type="text" name="banner_description" id="banner_description" class="form-control" placeholder="Description here..">{{ isset($data['description']) ? $data['description'] : '' }}</textarea>
                            @if($errors->has('banner_description'))
                                <div class="error">{{ $errors->first('banner_description') }}</div>
                            @endif
                        </div>

                        <div class="row">
                            <label for="text" class="col-12">Image <span class='required_field required_red'>*</span></label>
                            @if(isset($data['img']) && $data['img'] != '' )
                              <img src="{{ url($data['img']) }}" width="250" height="200">
                            @endif

                            <input type="file" name="banner_img" id="banner_img" class="form-control" placeholder="Choose Image">
                            @if($errors->has('banner_img'))
                                <div class="error">{{ $errors->first('banner_img') }}</div>
                            @endif
                            <input type="hidden" name="existing_banner_img" value="{{ isset($data['img1']) ? $data['img1'] : '' }}">
                        </div>
                        <input type="hidden" name="banner" value="aboutus">
                        <div class="col-12 btn-right">
                            <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                        </div>

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
   }
})
      
</script>


@endsection