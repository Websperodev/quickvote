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

                {!! Form::open(array('route' => 'team.saveData', 'id' => 'add_team_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
                @csrf

                <div id="faq" class="mb-2">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="heading" class="col-12">Heading</label>
                        <input type="text" class="form-control" value="{!! isset($teamData[0]['heading1']) ? $teamData[0]['heading1'] : '' !!}"  name="heading" id="heading" aria-describedby="emailHelp" placeholder="Enter Heading">
                        @if($errors->has('heading'))
                        <div class="error">{{ $errors->first('heading') }}</div>
                        @endif
                    </div>

                    <div class="col-md-12 form-group cus-form-group">
                        <label for="name" class="col-12">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control" placeholder="Description here..">{!! isset($teamData[0]['description']) ? $teamData[0]['description'] : '' !!}</textarea>

                        @if($errors->has('description'))
                        <div class="error">{{ $errors->first('description') }}</div>
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

bkLib.onDomLoaded(function () {
    new nicEditor({maxHeight: 100}).panelInstance('description');
});
</script>

@endsection