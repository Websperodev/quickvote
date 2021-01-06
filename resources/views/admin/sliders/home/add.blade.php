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

                {!! Form::open(array('route' => 'admin.add.homeSlider', 'id' => 'add_slider_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}

                    @csrf
                    <div class="slider mb-2">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="image" class="col-12">Image</label>
                            <input type="file" class="form-control" name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                            @if($errors->has('image'))
                                <div class="error">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 form-group cus-form-group">
                            <label for="name" class="col-12">Heading1</label>
                            <input type="text" class="form-control" name="heading1" id="heading1" aria-describedby="emailHelp" placeholder="Enter top heading">
                            @if($errors->has('heading1'))
                                <div class="error">{{ $errors->first('heading1') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="name" class="col-12">Heading2</label>
                            <input type="text" class="form-control" name="heading2" id="heading2" aria-describedby="emailHelp" placeholder="Enter top heading">
                            @if($errors->has('heading2'))
                                <div class="error">{{ $errors->first('heading2') }}</div>
                            @endif
                        </div>
            
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="description" class="col-12">Description</label>
                            <textarea type="text" name="description" id="description" class="form-control" placeholder="Description here.."></textarea>
                            @if($errors->has('description'))
                                <div class="error">{{ $errors->first('description') }}</div>
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
<script type="text/javascript" src="{{ URL::asset('assets/js/nicEdit-latest.js') }}"></script>
<script type="text/javascript">

bkLib.onDomLoaded(function() {
    new nicEditor({ maxHeight : 100 }).panelInstance('description');
});
</script>

@endsection