@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Testimonials @endsection
@section("page_title") <a class="head-a" href="{!! route('testimonials.index') !!}"> Testimonials </a> > Add @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Testimonials</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif

                {!! Form::open(array('route' => 'testimonials.store', 'id' => 'add_testimonial_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}

                	@csrf
                    <div id="add-frm">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="image" class="col-12">Image <span class='required_field required_red'>*</span></label>
                            <input type="file" class="form-control" name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                            @if($errors->has('image'))
                                <div class="error">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 form-group cus-form-group">
                            <label for="name" class="col-12">Name <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control"  name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
                            @if($errors->has('name'))
    						    <div class="error">{{ $errors->first('name') }}</div>
    						@endif
                     	</div>
            
                     	<div class="col-md-12 form-group cus-form-group">
                            <label for="description" class="col-12">Description <span class='required_field required_red'>*</span></label>
                            <textarea type="text" name="description" id="description" class="form-control" placeholder="Description here.."></textarea>
                            @if($errors->has('description'))
                                <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div>

                        <div class="btn-right">
                        <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                        </div>
                    </div>
                </form>
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