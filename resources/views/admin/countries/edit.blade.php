@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Countries @endsection
@section("page_title") <a href="{!! route('admin.categories') !!}" class="head-a"> Countries </a> > Edit @endsection


@section("content")

<div class="row justify-content-center">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Country Update</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif

                {!! Form::open(array('route' => 'admin.edit.country', 'id' => 'edit_country_form', 'class' => 'custum-frm', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
                @csrf
                <div class="categories-frm mb-2">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="name">Country Name</label>
                        <input type="text" class="form-control" value="{{ isset($country->name) ? $country->name : ''}}" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Company Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="col-md-12 form-group cus-form-group">
                        <label for="phonecode">Phone code</label>
                        <input type="text" class="form-control" value="{{ isset($country->phonecode) ? $country->phonecode : ''}}" name="phonecode" id="phonecode" aria-describedby="emailHelp" placeholder="+234">
                        @if($errors->has('phonecode'))
                        <div class="error">{{ $errors->first('phonecode') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="currency">Country Currency</label>
                        <input type="text" class="form-control" value="{{ isset($country->currency) ? $country->currency : ''}}" name="currency" id="currency" aria-describedby="emailHelp" placeholder="NGN">
                        @if($errors->has('currency'))
                        <div class="error">{{ $errors->first('currency') }}</div>
                        @endif
                    </div>




                    <input type="hidden" name="country_id" value="{{ isset($country->id ) ? $country->id  : ''}}"> 

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
@endsection