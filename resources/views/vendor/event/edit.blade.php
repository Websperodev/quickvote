@extends('vendor.layouts.master')
@section("meta_page_title") Vendor | Quickvote | Dashboard @endsection
@section("page_title") <a href="{!! route('admin.events') !!}" class="head-a"> Events </a> > Edit @endsection

@section("content")
@php 
$timezoneArray = config('constants.timezones');
@endphp
  <script src="{{url('js/evenEditValidation.js')}}"></script>
<script>
    var country = "{{$event->country_id}}";
    var state = "{{$event->state_id}}";
    var city = "{{$event->city_id}}";</script>
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
                {!! Form::open(array('route' => ['event.update', $event->id ], 'id' => 'edit_event_form', 'method' => 'put','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
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
                        <div class="col-md-6 form-group cus-form-group">
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
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="event_subcategory">Event Sub-Category</label>

                            <select class="form-control" name="subcategory_id"autocomplete="off" id="event_subcategory" aria-describedby="emailHelp">
                                <option value="{{$event->subcategory_id}}">{{subcategory_name($event->subcategory_id)}}</option>

                            </select>

                            @if($errors->has('subcategory_id'))
                            <div class="error">{{ $errors->first('subcategory_id') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 form-group cus-form-group">
                            <label for="event_priority">Event Priority</label>
                            <select class="form-control" name="event_priority"autocomplete="off" id="event_priority" aria-describedby="emailHelp">
                                <option value="">Choose Priority</option>
                                <option {{ ($event->event_priority == 'low') ? 'selected':'' }} value="low">Low</option>
                                <option {{ ($event->event_priority == 'medium') ? 'selected':'' }} value="medium">Medium</option>
                                <option {{ ($event->event_priority == 'high') ? 'selected':'' }} value="high">High</option>
                            </select>
                            @if($errors->has('event_priority'))
                            <div class="error">{{ $errors->first('event_priority') }}</div>
                            @endif
                        </div>
                    </div>
                    @php 
                    $eventStartDate = isset($event->start_date)? ucfirst($event->start_date) : '' ;
                    $eventStartDate = date("m/d/Y H:i", strtotime($eventStartDate));
                    $eventEndDate = isset($event->end_date)? ucfirst($event->end_date) : '';
                    $eventEndDate = date("m/d/Y H:i", strtotime($eventEndDate));
                    @endphp
                    <div class="row">
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" class="form-control datetimepicker" value="{{ $eventStartDate }}" name="start_date" id="start-date" aria-describedby="emailHelp" placeholder="Enter Start Date" >
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            @if($errors->has('start_date'))
                            <div class="error">{{ $errors->first('start_date') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="end_date">End Date</label>
                            <input type="text" class="form-control datetimepicker" value="{{ $eventEndDate }}" name="end_date" id="end_date" aria-describedby="emailHelp" placeholder="Enter End Date">
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
                            <img src="{{ url($event->image) }}" width="150" height="150">
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
                    <!--  <div class="row">
                         <div class="col-md-12 form-group cus-form-group">
                             <label for="venue">Venue</label>
                             <input type="text" class="form-control" value="{{ isset($event->venue)? ucfirst($event->venue) : ''}}" name="venue" id="venue" aria-describedby="emailHelp" placeholder="Enter Venue">
                             @if($errors->has('venue'))
                                 <div class="error">{{ $errors->first('venue') }}</div>
                             @endif
                         </div>
                     </div> -->
                    <?php
                    $eventCountry = isset($event->country_id) ? $event->country_id : '';
                    $eventState = isset($event->state_id) ? $event->state_id : '';
                    $eventCity = isset($event->city_id) ? $event->city_id : '';
                    ?>
                    <div class="row">
                        <div class="col-md-6 form-group cus-form-group">
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

                        <div class="col-md-6 form-group cus-form-group">
                            <label for="state">State</label>

                            <select class="form-control" name="state" id="state" aria-describedby="emailHelp">

                            </select>

                            @if($errors->has('state'))
                            <div class="error">{{ $errors->first('state') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 form-group cus-form-group">
                            <label for="city">City</label>
                            <select class="form-control" name="city" id="city" aria-describedby="emailHelp">

                            </select>

                            @if($errors->has('city'))
                            <div class="error">{{ $errors->first('city') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="timezone">Timezone</label>
                            <select class="form-control" name="timezone" id="timezone" aria-describedby="emailHelp">
                                <option value="">Choose Timezone</option>
                                @foreach($timezoneArray as $key=>$time)
                                <option value="{{ $key }}" {{ $key == $event->timezone ? 'selected' : ''}}>{{ $key }}</option>
                                @endforeach
                            </select>

                                <!-- <input type="text" class="form-control" value="{{ isset($event->timezone)? ucfirst($event->timezone) : ''}}" name="timezone" id="timezone" aria-describedby="emailHelp" placeholder="Enter Timezone"> -->
                            @if($errors->has('timezone'))
                            <div class="error">{{ $errors->first('timezone') }}</div>
                            @endif
                        </div>
                    </div>
                    @if(!empty($event->tickets))
                    @foreach($event->tickets as $ticket)
                    <div class="row">
                        <input type="hidden" value="{{ $ticket->id }}" name="ticket_id[]">
                        <div class="col-md-4 form-group cus-form-group">
                            <label for="image">Ticket Name</label>
                            <input type="text" value="{{ $ticket->name }}"  class="form-control" name="ticket_name[]" aria-describedby="emailHelp" placeholder="Ticket Name">
                        </div>
                        <div class="col-md-4 form-group cus-form-group">
                            <label for="image">Quantity available</label>
                            <input type="text" value="{{ $ticket->quantity }}" class="form-control" name="quantity[]" aria-describedby="emailHelp" placeholder="Quantity available">
                        </div>
                        <div class="col-md-2 form-group cus-form-group">
                            <label for="image">Price</label>
                            <input type="text" {{ ($ticket->ticket_type == 'free')? "readonly" :'' }} value="{{ $ticket->price }}" class="form-control" value="'+price+'" name="price[]" aria-describedby="emailHelp" placeholder="Price">
                        </div>
                        <div class="col-md-2 form-group cus-form-group">
                            <label for="image">Delete Ticket</label>
                            <a href="javascript:void(0)" class="" onclick='deleteTicket("{{ $ticket->id }}");'>Delete</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="image">Start Date</label>
                            <input type="date" value="{{ $ticket->start_date }}" class="form-control datepicker" name="ticket_start_date[]" aria-describedby="emailHelp" placeholder="Start date">
                        </div>
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="image">End Date</label>
                            <input type="date" value="{{ $ticket->end_date }}" class="form-control ticket_end_date" name="ticketend_date[]" aria-describedby="emailHelp" placeholder="End Date">
                        </div>
                        <input type="hidden" value="{{ $ticket->ticket_type }}" class="form-control" value="" name="ticket_type[]" aria-describedby="emailHelp" placeholder="Price"></div>
                    @endforeach
                    @endif

                    <button type="button" class="btn btn-bg ladda-button" data-toggle="modal" data-target="#ticketModal">Add Ticket</button>

                    <div id="ticket-div" class="input_fields_wrap">

                    </div>


                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="btn-right">
                        <button type="submit" class="btn btn-bg ladda-button">Update Event</button>
                    </div>
                </div>    
                {!! Form::close() !!}
            </div> <!-- end card-body-->
        </div> 
    </div>
</div> 

<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="lbl">What type of ticket do you want to add?</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group cus-form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-4 form-group cus-form-group">
                        <button type="button" class="btn btn-secondary paidclass" onclick="openModal('paid');">Paid Ticket</button>
                    </div>
                    <div class="col-md-4 form-group cus-form-group">
                        <button type="button" class="btn btn-secondary freeclass" onclick="openModal('free');">Free Ticket</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="FreeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="lbl">How many free ticket types do you wish to add?:</label>
                        <input type="text" autocomplete="off" class="form-control" name="ticket_no" id="free-no"  aria-describedby="emailHelp" placeholder="Enter Ticket no">
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4 form-group cus-form-group">
                        <button type="button" class="btn btn-secondary add_ticket_button">OK</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="paidModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="lbl">How many paid ticket types do you wish to add?:</label>
                        <input type="text" autocomplete="off" class="form-control" name="ticket_no" id="paid-no" aria-describedby="emailHelp" placeholder="Enter Ticket no">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group cus-form-group">
                        <button type="button" class="btn btn-secondary add_ticket_button">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!--<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>-->
<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>


<!--<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>-->

<script>
                            $(document).ready(function() {                                                              
                                 $('.ticketModal').on('click', function () {
                                var pricetype = $('.priceclass').val();
                                if (typeof (pricetype) == 'undefined') {
                                } else if (pricetype != 'free') {
                                    $('.freeclass').hide();
                                } else {
                                    $('.paidclass').hide();
                                }
                            })
                            if (country != '') {
                            var cid = country;
                            } else {
                            var cid = 1;
                            }

                            if (state != '') {
                            var stateId = state;
                            } else {
                            var stateId = 1;
                            }
                            if (city != '') {
                            var cityId = city;
                            } else {
                            var cityId = 1;
                            }

                            var url ='{{ route("allstates", ":id") }}';
                            url = url.replace(':id', cid);
                            var selected = '';
                            $.ajax({
                            type: 'GET',
                                    url: url,
                                    success: function (res) {
                                    if (res) {
                                    $("#state").empty();
                                    $("#state").append('<option value="">Select state</option>');
                                    $.each(res, function (key, value) {
                                    if (stateId == value.id) {
                                    selected = "selected";
                                    } else {
                                    selected = '';
                                    }
                                    $("#state").append('<option ' + selected + ' value="' + value.id + '">' + value.name + '</option>');
                                    });
                                    } else {
                                    $("#state").empty();
                                    }

                                    },
                                    error: function (err) {
                                    console.log(err);
                                    }
                            });
                            var cityUrl = '{{ route("allcities", ":id") }}';
                            cityUrl = cityUrl.replace(':id', stateId);
                            $.ajax({
                            type: 'GET',
                                    url: cityUrl,
                                    success: function (res) {
                                    if (res)
                                    {
                                    $("#city").empty();
                                    $("#city").append('<option value="">Select city</option>');
                                    $.each(res, function (key, value) {
                                    if (cityId == value.id) {
                                    selected = "selected";
                                    } else {
                                    selected = '';
                                    }
                                    $("#city").append('<option ' + selected + ' value="' + value.id + '">' + value.name + '</option>');
                                    });
                                    } else {

                                    $("#city").empty();
                                    }

                                    },
                                    error: function (err) {
                                    console.log(err);
                                    }

                            });
                            });
                            
                            
                            
                            
                            
                            $('#country').change(function () {
                            var cid = $(this).val();
                            var url = '{{ route("allstates", ":id") }}';
                            url = url.replace(':id', cid);
                            if (cid) {
                            $.ajax({
                            type: 'GET',
                                    url: url,
                                    success: function (res) {
                                    console.log('response', res);
                                    if (res) {
                                    $("#state").empty();
                                    $("#state").append('<option value="">Select state</option>');
                                    if (res != '') {
                                    var stateid = res[0].id;
                                    citylist(stateid);
                                    } else {
                                    $("#state").empty();
                                    $("#city").empty();
                                    }
                                    $.each(res, function (key, value) {
                                    $("#state").append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                                    } else {
                                    $("#state").empty();
                                    }
                                    },
                                    error: function (err) {
                                    console.log(err);
                                    }
                            });
                            }
                            });
                            
                            
                            
                            
                            
                            function citylist(stateid) {
                            var ctyurl = '{{ route("allcities", ":id") }}';
                            ctyurl = ctyurl.replace(':id', stateid);
                            $.ajax({
                            type: 'GET',
                                    url: ctyurl,
                                    success: function (res) {
                                    console.log('response', res);
                                    if (res)
                                    {
                                    $("#city").empty();
                                    $("#city").append('<option value="">Select city</option>');
                                    $.each(res, function (key, value) {
                                    $("#city").append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                                    } else {
                                    $("#city").empty();
                                    }

                                    },
                                    error: function (err) {
                                    console.log(err);
                                    }
                            });
                            }
                            
                            
                            
                            
                            $('#state').change(function () {
                            var sid = $(this).val();
                            citylist(sid);
                            });
                        
                    
                
           
                            CKEDITOR.replace('area1', {
                            height: '20%',
                                    width: '100%'
                            });
                            
    
                            $(document).ready(function() {
                                    var ticketNo = $('#free-no').val(); //maximum input boxes allowed
                            var wrapper = $(".input_fields_wrap"); //Fields wrapper
                            var add_button = $(".add_ticket_button"); //Add button ID

                            console.log('ticketNo', ticketNo);
                            var x = 0; //initlal text box count
                            $(add_button).click(function(e){ //on add input button click
                            // e.preventDefault();
                            var ticketNo = '';
                            var price = '';
                            var readonly = '';
                            var ttype = '';
                            if ($('#free-no').val() != ''){
                            ticketNo = $('#free-no').val();
                            price = 'free';
                            readonly = "readonly";
                            ttype = 'free';
                            }
                            if ($('#paid-no').val() != ''){
                            ticketNo = $('#paid-no').val();
                            ttype = 'paid';
                            }
                            console.log('aaa', ticketNo);
                            for (x = 0; x < ticketNo; x++){ //max input box allowed
                            //text box increment
                            console.log('x', x);
                            $(wrapper).append('<div class="row"><div class="col-md-4 form-group cus-form-group">\n\
    <label for="image">Ticket Name</label>\n\
        <input type="text"  class="form-control ticketclass" name="ticket_name[]" aria-describedby="emailHelp" required placeholder="Ticket Name"></div>\n\
    <div class="col-md-4 form-group cus-form-group"><label for="image">Quantity available</label>\n\
        <input type="text"  class="form-control ticketclass" name="quantity[]" aria-describedby="emailHelp" required placeholder="Quantity available"></div>\n\
    <div class="col-md-2 form-group cus-form-group">\n\
    <label for="image">Price</label>\n\
        <input type="text"  class="form-control priceclass ticketclass" ' + readonly + ' value="' + price + '"  name="price[]" required aria-describedby="emailHelp" placeholder="Price"></div>\n\
    <div class="col-md-2 form-group cus-form-group">\n\
    <label for="image">Remove Ticket</label><a href="#" class="remove_field">Remove</a></div>\n\
    <div class="col-md-6 form-group cus-form-group">\n\
    <label for="image">Start Date</label>\n\
       <input type="date"  class="form-control datepicker_init ticketclass" name="ticket_start_date[]" required aria-describedby="emailHelp" placeholder="Start date"></div>\n\
    <div class="col-md-6 form-group cus-form-group"><label for="image">End Date</label>\n\
         <input type="date" class="form-control ticket_end_date datepicker_init ticketclass" name="ticketend_date[]" required aria-describedby="emailHelp" placeholder="End Date"></div>\n\
         <input type="hidden"  class="form-control" value="' + ttype + '" name="ticket_type[]" aria-describedby="emailHelp" placeholder="Price"></div>');
                                }
                                $('#FreeModal').modal('hide');
                                $('#paidModal').modal('hide');
                                });
                                $(wrapper).on("click", ".remove_field", function(e){ //user click on remove text
                                e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
                                });
                            });
                            
                            
                            
                            
                            $(".datetimepicker").datetimepicker({
                                        format:'m/d/Y H:i'
                                });
                                    
                                    
                                    function openModal(par){
                                        if (par == 'paid'){
                                $('#paidModal').modal('show');
                                }
                                if (par == 'free'){
                                $('#FreeModal').modal('show');
                                }

                                $('#ticketModal').modal('hide');
                            }
                            
                            function deleteTicket(id){
                                        var url = '{{ route("deleteTicket", ":id") }}';
                                url = url.replace(':id', id);
                                console.log(url);
                                $.ajax({
                                type: 'GET',
                                        url: url,
                                        success: function (res) {
                                        console.log(res);
                                        if (res.success == true){
                                        Swal.fire({
                                        type: 'success',
                                                title: 'Success!',
                                                text: res.message,
                                                confirmButtonClass: 'btn btn-confirm mt-2',
                                        }).then((result) => {
                                        // Reload the Page
                                        location.reload();
                                        });
                                        } else{

                                        }

       },
            error: function(err) {
            console.log(err);
            }
    });
    }






</script>
        <script>
                                        $('#event_category').change(function () {
                                        var cid = $(this).val();
                                        var url = '{{ route("subcategories", ":id") }}';
                                        url = url.replace(':id', cid);
                                        if (cid) {
                                        $.ajax({
                                        type: 'GET',
                                                url: url,
                                                success: function (res) {
                                                console.log('response', res);
                                                if (res) {
                                                $("#event_subcategory").empty();
                                                $("#event_subcategory").append('<option value="">Select</option>');
                                                $.each(res, function (key, value) {
                                                $("#event_subcategory").append('<option value="' + value.id + '">' + value.name + '</option>');
                                                });
                                                } else {
                                                $("#event_subcategory").empty();
                                                }
                                                },
                                                error: function (err) {
                                                console.log(err);
                                                }
                                        });
                                        }
                                        });
                                        </script>
@endsection
@section('script-bottom')
@endsection