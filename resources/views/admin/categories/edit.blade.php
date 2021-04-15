@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Dashboard @endsection
@section("page_title") <a href="{!! route('admin.categories') !!}" class="head-a"> Categories </a> > Edit @endsection


@section("content")

<div class="row justify-content-center">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Category</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif

                {!! Form::open(array('route' => 'admin.edit-category', 'id' => 'edit_category_form', 'class' => 'custum-frm', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
                @csrf
                <div class="categories-frm mb-2">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="first_name">Category Name</label>
                        <input type="text" class="form-control" value="{{ isset($category->name) ? $category->name : ''}}" name="category_name" id="category_name" aria-describedby="emailHelp" placeholder="Enter Category Name">
                        @if($errors->has('category_name'))
                        <div class="error">{{ $errors->first('category_name') }}</div>
                        @endif
                    </div>

                    <div class="col-md-12 form-group cus-form-group">
                        <label for="image">Image</label>
                        @if(isset($category->image) && $category->image != '')
                        <img src="{{ url($category->image) ? $category->image :''}}" width="150" height="150">
                        @endif
                        <input type="hidden" name="old_file" value="{{ isset($category->image ) ? $category->image  : ''}}">
                        <input type="file" class="form-control" value="{{ isset($category->image) ? $category->image : ''}}" accept=".jpg,.jpeg,.png" name="image_name" id="image_name" aria-describedby="emailHelp" placeholder="Choose Image">
                        @if($errors->has('image_name'))
                        <div class="error">{{ $errors->first('image_name') }}</div>
                        @endif
                    </div>

                    <div class="col-md-12 form-group cus-form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control" placeholder="Description here..">{{ isset($category->description ) ? $category->description  : ''}}</textarea>
                        @if($errors->has('description'))
                        <div class="error">{{ $errors->first('description') }}</div>
                        @endif
                    </div>

                    <input type="hidden" name="category_id" value="{{ isset($category->id ) ? $category->id  : ''}}"> 

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
<!--<script type="text/javascript" src="{{ URL::asset('assets/js/nicEdit-latest.js') }}"></script>-->
<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
CKEDITOR.replace('description', {
    height: '20%',
    width: '100%'
});
//bkLib.onDomLoaded(function() {
//    new nicEditor({ maxHeight : 100 }).panelInstance('description');
//});
</script>



@endsection