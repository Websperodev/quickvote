@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Our Team @endsection
@section("page_title") <a href="{!! route('team.index') !!}" class="head-a"> Our Team </a> > Add @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Our Team</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif

                {!! Form::open(array('route' => 'team.store', 'id' => 'add_team_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
                	@csrf
                    <div id="faq" class="mb-2">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="question" class="col-12">Image <span class='required_field required_red'>*</span></label>
                            <input type="file" class="form-control"  name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                            @if($errors->has('image'))
    						    <div class="error">{{ $errors->first('image') }}</div>
    						@endif
                     	</div>
            
                     	<div class="col-md-12 form-group cus-form-group">
                            <label for="name" class="col-12">Name <span class='required_field required_red'>*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" />
                            @if($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 form-group cus-form-group">
                            <label for="designation" class="col-12">Designation <span class='required_field required_red'>*</span></label>
                            <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter designation" />
                            @if($errors->has('designation'))
                                <div class="error">{{ $errors->first('designation') }}</div>
                            @endif
                        </div>

                        <div class="col-12 btn-right">
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
    new nicEditor({ maxHeight : 100 }).panelInstance('answer');
});
</script>

@endsection