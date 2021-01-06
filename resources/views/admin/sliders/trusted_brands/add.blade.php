@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Slider @endsection
@section("page_title") <a href="{!! route('admin.slider',['name' => 'trusted_brands']) !!}" class="head-a">Slider</a> > Add @endsection


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

                {!! Form::open(array('route' => 'admin.add.trustedBrands', 'id' => 'add_slider_form', 'method' => 'post', 'class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}

                    @csrf
                    <div class="slider mb-2">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="image" class="col-12">Image</label>
                            <input type="file" class="form-control" name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                            @if($errors->has('image'))
                                <div class="error">{{ $errors->first('image') }}</div>
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