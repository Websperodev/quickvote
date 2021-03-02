@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Countries @endsection
@section("page_title") <a href="{!! route('admin.categories') !!}" class="head-a"> Categories </a> > Add @endsection
@section("content")
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Countries</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif
                {!! Form::open(array('route' => 'admin.add.state', 'id' => 'add_state_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
                @csrf
                <div class="categories-frm mb-2">
                     <div class="col-md-12 form-group cus-form-group">
                        <label for="country_id">Select Country</label>
                        <select class="form-control" name="country_id"autocomplete="off" id="country_id" aria-describedby="emailHelp">
                            <option value="">Choose Category</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('country_id'))
                        <div class="error">{{ $errors->first('country_id') }}</div>
                        @endif
                    </div> 
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="name">State Name</label>
                        <input type="text" class="form-control"  name="name" id="name" aria-describedby="emailHelp" placeholder="Enter State Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                     <div class="col-md-12 form-group cus-form-group">
                        <label for="name">Country code</label>
                        <input type="text" class="form-control"  name="country_code" id="country_code" aria-describedby="emailHelp" placeholder="NA">
                        @if($errors->has('country_code'))
                        <div class="error">{{ $errors->first('country_code') }}</div>
                        @endif
                    </div>
                    
                                  
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