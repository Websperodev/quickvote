@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Pricing Plans @endsection
@section("page_title") Pricing Plans @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Pricing Plans Page</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif

                 {!! Form::open(array('route' => 'admin.pages.pricing', 'id' => 'add_pricing_form','class' => 'custum-frm', 'method' => 'post', 'enctype' => 'multipart/form-data' )) !!}

                    @csrf

                   <!--  <div class="top-banner">
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
 -->
                    <div class="row">
                        <label for="heading">Page Heading</label>
                        <input type="text" class="form-control"  name="page_heading" value="{{ isset($data['page_heading']) ? $data['page_heading'] :''}}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                        @if($errors->has('page_heading'))
                            <div class="error">{{ $errors->first('page_heading') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <label for="heading">Page Text</label>
                        <textarea type="text" name="page_text" id="page_text" class="form-control" placeholder="Description here..">{{ isset($data['description']) ? $data['description'] :''}}</textarea>
                        @if($errors->has('page_text'))
                            <div class="error">{{ $errors->first('page_text') }}</div>
                        @endif
                    </div>

                   
                    <div class="row">
                        <label for="heading">Plan Type</label>
                        <input type="text" class="form-control"  name="plan_type[]" value="{{ isset($data['planType1']) ? $data['planType1'] :''}}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                        @if($errors->has('plan_type'))
                            <div class="error">{{ $errors->first('plan_type') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <label for="heading">Plan Amount</label>
                        <input type="text" class="form-control"  name="plan_amount[]" value="{{ isset($data['planAmount1']) ? $data['planAmount1'] :''}}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                        @if($errors->has('plan_amount'))
                            <div class="error">{{ $errors->first('plan_amount') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <label for="heading">Plan Heading</label>
                        <input type="text" class="form-control"  name="plan_heading[]" value="{{ isset($data['planHeading1']) ? $data['planHeading1'] :''}}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                        @if($errors->has('plan_heading'))
                            <div class="error">{{ $errors->first('plan_heading') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <label for="text">Features</label>
                        <textarea type="text" name="features[]" id="features" class="form-control" placeholder="Description here..">{{ isset($data['planFeatures1']) ? $data['planFeatures1'] :''}}</textarea>
                        @if($errors->has('features'))
                            <div class="error">{{ $errors->first('features') }}</div>
                        @endif
                    </div>  
                    <div class="row">
                        <label for="heading">Button Text</label>
                        <input type="text" class="form-control"  name="button_text[]" value="{{ isset($data['planButtonText1']) ? $data['planButtonText1'] :''}}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter Button text">
                        @if($errors->has('button_text'))
                            <div class="error">{{ $errors->first('button_text') }}</div>
                        @endif
                    </div>

                     <div class="row">
                        <label for="heading">Plan Type</label>
                        <input type="text" class="form-control"  name="plan_type[]" value="{{ isset($data['planType2']) ? $data['planType2'] :''}}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                        @if($errors->has('plan_type'))
                            <div class="error">{{ $errors->first('plan_type') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <label for="heading">Plan Amount</label>
                        <input type="text" class="form-control"  name="plan_amount[]" value="{{ isset($data['planAmount2']) ? $data['planAmount2'] :''}}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                        @if($errors->has('plan_amount'))
                            <div class="error">{{ $errors->first('plan_amount') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <label for="heading">Plan Heading</label>
                        <input type="text" class="form-control"  name="plan_heading[]" value="{{ isset($data['planHeading2']) ? $data['planHeading2'] :''}}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter heading">
                        @if($errors->has('plan_heading'))
                            <div class="error">{{ $errors->first('plan_heading') }}</div>
                        @endif
                    </div>
                    <div class="row">
                        <label for="text">Features</label>
                        <textarea type="text" name="features[]" id="features" class="form-control" placeholder="Description here..">{{ isset($data['planFeatures2']) ? $data['planFeatures2'] :''}}</textarea>
                        @if($errors->has('features'))
                            <div class="error">{{ $errors->first('features') }}</div>
                        @endif
                    </div>  
                    <div class="row">
                        <label for="heading">Button Text</label>
                        <input type="text" class="form-control"  name="button_text[]" value="{{ isset($data['planButtonText2']) ? $data['planButtonText2'] :''}}" id="banner_heading2" aria-describedby="emailHelp" placeholder="Enter Button text">
                        @if($errors->has('button_text'))
                            <div class="error">{{ $errors->first('button_text') }}</div>
                        @endif
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

// $('#add_pricing_form').validate({
//     rules:{
//         banner_heading1:{
//             required:true,
//         },
//         banner_heading2:{
//             required:true,
//         },
//         features:{
//             required:true,
//         },
//         button_text:{
//             required:true,
//         }.
//     },
//     messages:{
//         banner_heading1:{
//           required:"Banner top heading is required",
//         },
//         banner_heading2:{
//           required:"Banner heading is required",
//         },
//         features:{
//           required:"features text is required",
//         },
//         button_text:{
//             required:"Button text is required",
//         }
//    }
// })
    
   
    
</script>


@endsection