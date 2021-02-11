@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Faqs @endsection
@section("page_title") <a href="{!! route('faqs.index') !!}" class="head-a"> Faqs </a> > Add @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Faqs</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif

                {!! Form::open(array('route' => 'faqs.store', 'id' => 'add_faq_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
                	@csrf
                    <div id="faq" class="mb-2">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="question" class="col-12">Question <span class='required_field required_red'>*</span></label>
                            <input type="text" class="form-control"  name="question" id="question" aria-describedby="emailHelp" placeholder="Enter question">
                            @if($errors->has('question'))
    						    <div class="error">{{ $errors->first('question') }}</div>
    						@endif
                     	</div>
            
                     	<div class="col-md-12 form-group cus-form-group">
                            <label for="answer" class="col-12">Answer <span class='required_field required_red'>*</span></label>
                            <textarea type="text" name="answer" id="answer" class="form-control" placeholder="answer here.."></textarea>
                            @if($errors->has('answer'))
                                <div class="error">{{ $errors->first('answer') }}</div>
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
<!--<script type="text/javascript" src="{{ URL::asset('assets/js/nicEdit-latest.js') }}"></script>-->
<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
CKEDITOR.replace('answer', {
    height: '20%',
    width: '100%'
});
//bkLib.onDomLoaded(function() {
//    new nicEditor({ maxHeight : 100 }).panelInstance('answer');
//});
</script>

@endsection