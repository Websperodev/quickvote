@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Slider @endsection
@section("page_title") Slider @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Slider</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif

                {!! Form::open(array('route' => 'admin.edit.homeSlider', 'id' => 'edit_slider_form', 'class' => 'custum-frm','method' => 'post', 'enctype' => 'multipart/form-data' )) !!}

                    @csrf
                    <div class="slider mb-2">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="image" class="col-12">Image <span class='required_field required_red'>*</span></label>
                            @if(isset($slider->img1) && $slider->img1 != '')
                                <img src="{{ isset($slider->img1) ? url($slider->img1) : ''}}" width="150" height="150">
                            @endif
                            <input type="file" class="form-control" name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">

                            <input type="hidden" value="{{ isset($slider->img1) ? $slider->img1 : '' }}" name="existing_img">
                            @if($errors->has('image'))
                                <div class="error">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 form-group cus-form-group">
                            <label for="name" class="col-12">Heading1 <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control" value="{{ isset($slider->heading1) ? $slider->heading1 : '' }}" name="heading1" id="heading1" aria-describedby="emailHelp" placeholder="Enter top heading">
                            @if($errors->has('heading1'))
                                <div class="error">{{ $errors->first('heading1') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="name" class="col-12">Heading2 <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control" value="{{ isset($slider->heading2) ? $slider->heading2 : '' }}" name="heading2" id="heading2" aria-describedby="emailHelp" placeholder="Enter top heading">
                            @if($errors->has('heading2'))
                                <div class="error">{{ $errors->first('heading2') }}</div>
                            @endif
                        </div>
            
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="description" class="col-12">Description</label>
                            <textarea type="text" name="description" id="description" class="form-control" placeholder="Description here..">{{ isset($slider->description) ? $slider->description : '' }}</textarea>
                            @if($errors->has('description'))
                                <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                        <input type="hidden" value="{{ isset($slider->id) ? $slider->id : '' }}" name="id">
                        <div class="btn-right">
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
<script type="text/javascript" src="{{ URL::asset('assets/js/nicEdit-latest.js') }}"></script>
<script type="text/javascript">

bkLib.onDomLoaded(function() {
    new nicEditor({ maxHeight : 100 }).panelInstance('description');
});
</script>

@endsection