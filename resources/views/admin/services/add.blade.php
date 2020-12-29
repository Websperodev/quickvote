@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Services @endsection
@section("page_title") Services @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Services</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif

                
                	@csrf

                    {!! Form::open(array('route' => 'services.store', 'id' => 'add_services_form', 'method' => 'post', 'enctype' => 'multipart/form-data' )) !!}

                    @php
                    $limit = '';
                    @endphp
                    

                    @if( isset($service_type) && $service_type == 'top')
                        @php $limit = '3'; @endphp
                    @else
                         @php $limit = '4'; @endphp
                    @endif

                    @if(isset($services) && count($services) == 0)
                       
                      @for($i=1; $i<= $limit; $i++)
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="image">Image {{$i}}</label>
                            <input type="file" class="form-control" name="image[]" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                            @if($errors->has('image'))
                                <div class="error">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 form-group cus-form-group">
                            <label for="name">Name {{$i}}</label>
                            <input type="text" class="form-control"  name="name[]" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
                            @if($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 form-group cus-form-group">
                            <label for="description">Description {{$i}}</label>
                            <textarea type="text" name="description[]" id="description{{ $i }}" class="form-control" placeholder="Description here.."></textarea>
                            @if($errors->has('description'))
                                <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div>

                      @endfor

                        <input type="hidden" name="type" value="{{ $service_type }}">
                        <div class="btn-right">
                            <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                        </div>
                        {!! Form::close() !!}

                    @else  
                      
                        @foreach($services as $i => $service)
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="image">Image {{$i+1}}</label>
                            <img src="{{ url($service->image) }}" width="150" height="150">
                            <input type="hidden" name="existing_img[]" value="{{ $service->image }}">

                            <input type="file" class="form-control" name="image[]" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                            @if($errors->has('image'))
                                <div class="error">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 form-group cus-form-group">
                            <label for="name">Name {{$i+1}}</label>
                            <input type="text" class="form-control" value="{{ $service->name }}"  name="name[]" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
                            @if($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 form-group cus-form-group">
                            <label for="description">Description {{$i+1}}</label>
                            <textarea type="text" name="description[]" id="description{{ $i }}" class="form-control" placeholder="Description here..">{{ $service->text }}</textarea>
                            @if($errors->has('description'))
                                <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                         <input type="hidden" name="existing_id[]" value="{{ $service->id }}">
                        
                      @endforeach
                        <input type="hidden" name="type" value="{{ $service_type }}">
                        <div class="btn-right">
                            <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                        </div>

                      {!! Form::close() !!}
                    @endif

                  
                    

                    
                   

                    
                
            </div> <!-- end card-body-->
        </div> 
    </div>
</div> 
@endsection



@section('script-bottom')
<script type="text/javascript" src="{{ URL::asset('assets/js/nicEdit-latest.js') }}"></script>
<script type="text/javascript">

bkLib.onDomLoaded(function() {
    new nicEditor({ maxHeight : 100 }).panelInstance('description1');
    new nicEditor({ maxHeight : 100 }).panelInstance('description2');
    new nicEditor({ maxHeight : 100 }).panelInstance('description3');
    new nicEditor({ maxHeight : 100 }).panelInstance('description4');
});
</script>

@endsection