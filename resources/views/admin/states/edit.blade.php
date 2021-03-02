@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | States @endsection
@section("page_title") <a href="{!! route('admin.categories') !!}" class="head-a"> States </a> > Edit @endsection


@section("content")

<div class="row justify-content-center">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">State Update</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif

                {!! Form::open(array('route' => 'admin.edit.state', 'id' => 'edit_state_form', 'class' => 'custum-frm', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
                @csrf
                <div class="categories-frm mb-2">
                     <div class="col-md-12 form-group cus-form-group">
                            <label for="country_id">Country</label>
                            <select class="form-control" name="country_id" id="country_id" aria-describedby="emailHelp">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option {{ $state->country_id == $country->id ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country_id'))
                            <div class="error">{{ $errors->first('country_id') }}</div>
                            @endif
                        </div>
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="name">State Name</label>
                        <input type="text" class="form-control" value="{{ isset($state->name) ? $state->name : ''}}" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Company Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="col-md-12 form-group cus-form-group">
                        <label for="country_code">Country code</label>
                        <input type="text" class="form-control" value="{{ isset($state->country_code) ? $state->country_code : ''}}" name="country_code" id="country_code" aria-describedby="emailHelp" placeholder="NA">
                        @if($errors->has('country_code'))
                        <div class="error">{{ $errors->first('country_code') }}</div>
                        @endif
                    </div>
                  




                    <input type="hidden" name="state_id" value="{{ isset($state->id ) ? $state->id  : ''}}"> 

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