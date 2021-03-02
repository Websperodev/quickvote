@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Cities @endsection
@section("page_title") <a href="{!! route('admin.cities.index') !!}" class="head-a"> cities </a> > Edit @endsection


@section("content")

<div class="row justify-content-center">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">city Update</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif

                {!! Form::open(array('route' => 'admin.edit.city', 'id' => 'edit_city_form', 'class' => 'custum-frm', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
                @csrf
                <div class="categories-frm mb-2">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="country_id">State</label>
                        <select class="form-control" name="state_id" id="state_id" aria-describedby="emailHelp">
                            <option value="">Select state</option>
                            @foreach($states as $state)
                            <option {{ $city->state_id == $state->id ? 'selected' : ''}} value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('state_id'))
                        <div class="error">{{ $errors->first('state_id') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="name">City Name</label>
                        <input type="text" class="form-control" value="{{ isset($city->name) ? $city->name : ''}}" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Company Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <input type="hidden" name="city_id" value="{{ isset($city->id ) ? $city->id  : ''}}"> 
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