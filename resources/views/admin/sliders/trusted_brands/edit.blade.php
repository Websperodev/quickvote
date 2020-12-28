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

                {!! Form::open(array('route' => 'admin.edit.trustedBrandsSlider', 'id' => 'edit_slider_form', 'method' => 'post', 'enctype' => 'multipart/form-data' )) !!}

                    @csrf

                    <div class="col-md-12 form-group cus-form-group">
                        <label for="image">Image</label>
                        @if(isset($slider->img1) && $slider->img1 != '')
                            <img src="{{ isset($slider->img1) ? url($slider->img1) : ''}}" width="150" height="150">
                        @endif
                        <input type="file" class="form-control" name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">

                        <input type="hidden" value="{{ isset($slider->img1) ? $slider->img1 : '' }}" name="existing_img">
                        @if($errors->has('image'))
                            <div class="error">{{ $errors->first('image') }}</div>
                        @endif
                    </div>

                   
                    <input type="hidden" value="{{ isset($slider->id) ? $slider->id : '' }}" name="id">
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


@endsection