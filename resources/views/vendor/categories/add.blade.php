@extends('vendor.layouts.master')
@section("meta_page_title") Vendor | Quickvote | Dashboard @endsection
@section("page_title") <a href="{!! route('event-categories.index') !!}" class="head-a"> Categories </a> > Add @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Categories</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif

                {!! Form::open(array('route' => 'event-categories.store', 'id' => 'add_category_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}

                	@csrf
                    <div class="categories-frm mb-2">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="category_name">Category Name <span class="required_field required_red">*</span></label>
                            <input type="text" class="form-control"  name="category_name" id="category_name" aria-describedby="emailHelp" placeholder="Enter Category Name">
                            @if($errors->has('category_name'))
    						    <div class="error">{{ $errors->first('category_name') }}</div>
    						@endif
                     	</div>

                        <div class="col-md-12 form-group cus-form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image_name" id="image_name" aria-describedby="emailHelp" placeholder="Choose Image">
                            @if($errors->has('image'))
    						    <div class="error">{{ $errors->first('image') }}</div>
    						@endif
                        </div>
            
                     	<div class="col-md-12 form-group cus-form-group">
                            <label for="description">Description</label>
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