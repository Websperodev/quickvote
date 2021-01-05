@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Contact @endsection
@section("page_title") Contact @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Contact Page</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif
                 {!! Form::open(array('route' => 'admin.pages.contact', 'id' => 'add_contact_form','class' => 'custum-frm', 'method' => 'post', 'enctype' => 'multipart/form-data' )) !!}

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

<script type="text/javascript">
    

$('#add_contact_form').validate({
    rules:{
        banner_heading1:{
            required:true,
        },
        banner_heading2:{
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
   }
})
    
   
    
</script>


@endsection