@extends('vendor.layouts.master')
@section("meta_page_title") Vendor | Quickvote | Dashboard @endsection
@section("page_title") <a href="{!! route('vendor-categories.index') !!}" class="head-a"> Categories </a> > Add @endsection


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

                {!! Form::open(array('route' => 'vendor-categories.store', 'id' => 'add_category_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}

                @csrf
                <div class="categories-frm mb-2">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" name="category_id"autocomplete="off" id="event_category" aria-describedby="emailHelp">
                            <option value="">Choose Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        @if($errors->has('category_id'))
                        <div class="error">{{ $errors->first('category_id') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="name">Subcategory Name <span class="required_field required_red">*</span></label>
                        <input type="text" class="form-control"  name="name" id="category_name" aria-describedby="emailHelp" placeholder="Enter Subcategory Name">
                        @if($errors->has('category_name'))
                        <div class="error">{{ $errors->first('name') }}</div>
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
<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
CKEDITOR.replace('description', {
    height: '20%',
    width: '100%'
});

</script>

@endsection