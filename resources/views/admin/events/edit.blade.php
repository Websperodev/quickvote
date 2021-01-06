@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Dashboard @endsection
@section("page_title") <a href="{!! route('admin.events') !!}" class="head-a"> Events </a> > Edit @endsection

@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Events</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif

                {!! Form::open(array('route' => 'admin.edit.event', 'id' => 'edit_event_form', 'class' => 'custum-frm'  ,'method' => 'post', 'enctype' => 'multipart/form-data' )) !!}
                    @csrf
                    <div class="events-frm mb-2">
                        <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="event_title">Event Title</label>
                                <input type="text" class="form-control" value="{{ isset($event->name)? ucfirst($event->name) : '' }}" name="event_title" id="event_title" aria-describedby="emailHelp" placeholder="Enter Event title">
                                @if($errors->has('event_title'))
                                    <div class="error">{{ $errors->first('event_title') }}</div>
                                @endif
                            </div>
                        </div>
                        <?php
                        $eventCategory = isset($event->category_id) ? $event->category_id : '';
                        ?>
                        <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="event_category">Event Category</label>

                                <select class="form-control" name="event_category" id="event_category" aria-describedby="emailHelp">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option {{ $eventCategory == $category->id ? 'selected' : ''}}  value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                
                                @if($errors->has('event_category'))
                                    <div class="error">{{ $errors->first('event_category') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="start_date">Start Date</label>
                                <input type="text" class="form-control datepicker" value="{{ isset($event->start_date)? ucfirst($event->start_date) : '' }}" name="start_date" id="start-date" aria-describedby="emailHelp" placeholder="Enter Start Date" >

                                <i class="fa fa-calendar" aria-hidden="true"></i>

                              
                                @if($errors->has('start_date'))
                                    <div class="error">{{ $errors->first('start_date') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="end_date">End Date</label>
                                <input type="text" class="form-control datepicker" value="{{ isset($event->end_date)? ucfirst($event->end_date) : '' }}" name="end_date" id="end_date" aria-describedby="emailHelp" placeholder="Enter End Date">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                @if($errors->has('end_date'))
                                    <div class="error">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="image">Image</label>
                                @if(isset($event->image) && $event->image != '' )
                                <img src="{{ $event->image }}" width="150" height="150">
                                @endif
                                <input type="file"  class="form-control" name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                                @if($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="organiser_name">Organiser Name</label>
                                <input type="text"  class="form-control" name="organiser_name" id="organiser_name" value="{{ isset($event->organizer_name)? ucfirst($event->organizer_name) : ''}}" aria-describedby="emailHelp" placeholder="Enter Organiser">
                                @if($errors->has('organiser_name'))
                                    <div class="error">{{ $errors->first('organiser_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="description">Description</label>
                                <textarea type="text" cols="50" class="form-control" name="description" id="area1" placeholder="Description here..">{{ isset($event->description)? ucfirst($event->description) : ''}} 
                                </textarea>
                                @if($errors->has('description'))
                                    <div class="error">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="venue">Venue</label>
                                <input type="text" class="form-control" value="{{ isset($event->venue)? ucfirst($event->venue) : ''}}" name="venue" id="venue" aria-describedby="emailHelp" placeholder="Enter Venue">
                                @if($errors->has('venue'))
                                    <div class="error">{{ $errors->first('venue') }}</div>
                                @endif
                            </div>
                        </div>
                        <?php
                            $eventCountry = isset($event->country_id) ? $event->country_id : '';
                            $eventState = isset($event->state_id) ? $event->state_id : '';
                            $eventCity = isset($event->city_id) ? $event->city_id : '';
                        ?>
                        <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="country">Country</label>
                                
                                <select class="form-control" name="country" id="country" aria-describedby="emailHelp">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option {{ $eventCountry == $country->id ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('country'))
                                    <div class="error">{{ $errors->first('country') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="state">State</label>
                                
                                <select class="form-control" name="state" id="state" aria-describedby="emailHelp">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option {{ $eventState == $state->id ? 'selected' : ''}} value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('state'))
                                    <div class="error">{{ $errors->first('state') }}</div>
                                @endif
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="city">City</label>
                                <select class="form-control" name="city" id="city" aria-describedby="emailHelp">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                        <option {{ $eventCity == $city->id ? 'selected' : ''}} value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                
                                @if($errors->has('city'))
                                    <div class="error">{{ $errors->first('city') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="timezone">Timezone</label>
                                <input type="text" class="form-control" value="{{ isset($event->timezone)? ucfirst($event->timezone) : ''}}" name="timezone" id="timezone" aria-describedby="emailHelp" placeholder="Enter Timezone">
                                @if($errors->has('timezone'))
                                    <div class="error">{{ $errors->first('timezone') }}</div>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="event_id" value="{{ $event->id }}">

                        <div class="btn-right">
                        <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                        </div>
                    </div>    
                {!! Form::close() !!}
            </div> <!-- end card-body-->
        </div> 
    </div>
</div> 


<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">

$( "#start-date" ).datepicker({
    format: "mm/dd/yy",
    weekStart: 0,
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    rtl: true,
    orientation: "auto"
});

$( "#end_date" ).datepicker({
    format: "mm/dd/yy",
    weekStart: 0,
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    rtl: true,
    orientation: "auto"
});



bkLib.onDomLoaded(function() {
        new nicEditor({ maxHeight : 100 }).panelInstance('area1');
        
        // new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
        // new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
        // new nicEditor({maxHeight : 100}).panelInstance('area5');
});

  $('#country').change(function(){
        var cid = $(this).val();
        var url = '{{ route("states", ":id") }}';
        url = url.replace(':id', cid);
       
        if(cid){
            $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (res) {
                      console.log('response',res);
                      if(res){
                        $("#state").empty();
                        $("#state").append('<option>Select</option>');
                        $.each(res,function(key,value){
                          $("#state").append('<option value="'+key+'">'+value+'</option>');
                        });
                      
                      }else{
                        $("#state").empty();
                      }
                      
                    },
                    error: function(err) {
                      console.log(err);
                    }
            });
        }

       
    });
    $('#state').change(function(){
        var sid = $(this).val();

        var url = '{{ route("cities", ":id") }}';
        url = url.replace(':id', sid);
       console.log(url);

        if(sid){
            $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (res) {
                    console.log('response',res);
                        if(res)
                        {
                            $("#city").empty();
                            $("#city").append('<option>Select City</option>');
                            $.each(res,function(key,value){
                                $("#city").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }else{
                            $("#city").empty();
                        }
                      
                    },
                    error: function(err) {
                      console.log(err);
                    }
            });
        }       
        
    }); 
 
</script>

@endsection



@section('script-bottom')


@endsection