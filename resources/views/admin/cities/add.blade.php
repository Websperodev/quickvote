@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Cities @endsection
@section("page_title") <a href="{!! route('admin.cities.index') !!}" class="head-a"> City </a> > Add @endsection
@section("content")
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">States</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif
                {!! Form::open(array('route' => 'admin.add.city', 'id' => 'add_state_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
                @csrf
                <div class="categories-frm mb-2">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="state_id">Select State</label>
                        <select class="form-control" name="state_id"autocomplete="off" id="state_id" aria-describedby="emailHelp">
                            <option value="">Choose State</option>
                            @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('state_id'))
                        <div class="error">{{ $errors->first('state_id') }}</div>
                        @endif
                    </div> 
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="name">City Name</label>
                        <input type="text" class="form-control"  name="name" id="name" aria-describedby="emailHelp" placeholder="Enter State Name">
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
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