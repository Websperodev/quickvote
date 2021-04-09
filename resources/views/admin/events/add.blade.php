@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Dashboard @endsection
@section("page_title") <a href="{!! route('admin.events') !!}" class="head-a"> Events </a> > Add @endsection


@section("content")

@php 
$timezoneArray = config('constants.timezones');
@endphp


<!-- $timezoneArray = timezone_identifiers_list(); -->
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

                {!! Form::open(array('route' => 'admin.add.event', 'id' => 'add_event_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
                @csrf
                <div class="events-frm mb-2">
                    <div class="row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="event_title">Event Title</label>
                            <input type="text" class="form-control" autocomplete="off" name="event_title" id="event_title" aria-describedby="emailHelp" placeholder="Enter Event title">
                            @if($errors->has('event_title'))
                            <div class="error">{{ $errors->first('event_title') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="event_category">Event Category</label>

                            <select class="form-control" name="event_category"autocomplete="off" id="event_category" aria-describedby="emailHelp">
                                <option value="">Choose Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('event_category'))
                            <div class="error">{{ $errors->first('event_category') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="event_priority">Event Priority</label>
                            <select class="form-control" name="event_priority"autocomplete="off" id="event_priority" aria-describedby="emailHelp">
                                <option value="">Choose Priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                            @if($errors->has('event_priority'))
                            <div class="error">{{ $errors->first('event_priority') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" autocomplete="off" class="form-control datetimepicker" name="start_date" id="start-date" aria-describedby="emailHelp" placeholder="Enter Start Date" >

                            <i class="fa fa-calendar" aria-hidden="true"></i>


                            @if($errors->has('start_date'))
                            <div class="error">{{ $errors->first('start_date') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="end_date">End Date</label>
                            <input type="text" autocomplete="off" class="form-control datetimepicker" name="end_date" id="end_date" aria-describedby="emailHelp" placeholder="Enter End Date">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            @if($errors->has('end_date'))
                            <div class="error">{{ $errors->first('end_date') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="image">Image</label>
                            <input type="file"  class="form-control" name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                            @if($errors->has('image'))
                            <div class="error">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="organiser_name">Organiser Name</label>
                            <input type="text" autocomplete="off" class="form-control" name="organiser_name" id="organiser_name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" aria-describedby="emailHelp" placeholder="Enter Organiser">
                            @if($errors->has('organiser_name'))
                            <div class="error">{{ $errors->first('organiser_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">    
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="description">Description</label>
                            <textarea type="text"  cols="50" class="form-control" name="description" id="area1" placeholder="Description here..">
                            </textarea>
                            @if($errors->has('description'))
                            <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                    </div>

                    <!--  <div class="row">
                         <div class="col-md-12 form-group cus-form-group">
                             <label for="venue">Venue</label>
                             <input type="text" class="form-control" name="venue" id="venue" aria-describedby="emailHelp" placeholder="Enter Venue">
                             @if($errors->has('venue'))
                                 <div class="error">{{ $errors->first('venue') }}</div>
                             @endif
                         </div>
                     </div> -->

                    <div class="row">
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="country">Country</label>

                            <select class="form-control" autocomplete="off" name="country" id="country" aria-describedby="emailHelp">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option {{ ($country->id == '1') ? 'selected':'' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('country'))
                            <div class="error">{{ $errors->first('country') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="state">State</label>
                            <select class="form-control" autocomplete="off" name="state" id="state" aria-describedby="emailHelp">
                                <option value="">Select State</option>
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
                                <option value="">Select City</option>  
                            </select>

                            @if($errors->has('city'))
                            <div class="error">{{ $errors->first('city') }}</div>
                            @endif
                        </div>


                        <div class="col-md-6 form-group cus-form-group">
                            <label for="timezone">Timezone</label>

                            <select class="form-control" name="timezone" id="timezone" aria-describedby="emailHelp">

                                @foreach($timezoneArray as $key=>$time)
                                @if($key=='Africa/Lagos')
                                <option value="{{ $key }}" selected>{{ $key }}</option>                                
                                @else
                                <option value="{{ $key }}">{{ $key }}</option>
                                @endif
                                @endforeach
                            </select>

                            @if($errors->has('timezone'))
                            <div class="error">{{ $errors->first('timezone') }}</div>
                            @endif
                        </div>
                    </div>

                    <button type="button" class="btn btn-bg ladda-button ticketModal" data-toggle="modal" data-target="#ticketModal">Add Ticket</button>

                    <div id="ticket-div" class="input_fields_wrap">

                    </div>
                    <input type="hidden"  name="addticketcheck" class="addticketcheck"  value="">

                    @if($errors->has('addticketcheck'))
                    <div class="error">@php echo 'Ticket must be added with event'; @endphp</div>
                    @endif
                    <div class="btn-right">
                        <button type="submit" class="btn btn-bg ladda-button">Create Event</button>
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
                    <div class="col-md-4 form-group cus-form-group ">
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
<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>

<script src="{{url('js/eventValidation.js')}}"></script>
<script type="text/javascript">
                            $('.ticketModal').on('click', function () {
                                var pricetype = $('.priceclass').val();

                                if (typeof (pricetype) == 'undefined') {

                                } else if (pricetype != 'free') {
                                    $('.freeclass').hide();
                                } else {
                                    $('.paidclass').hide();
                                }

                            })
//                            $(".datepicker_init").datepicker({
//                                dateFormat: 'dd-mm-yy',
//                                changeMonth: true,
//                                changeYear: true,
//                                showAnim: 'slideDown',
//                                duration: 'fast',
//                                yearRange: new Date().getFullYear() + ':' + new Date().getFullYear(),
//                            });</script> 
<script type="text/javascript">
    $(document).ready(function () {
        var cid = 1;
        var url = '{{ route("states", ":id") }}';
        url = url.replace(':id', cid);



        var cityId = 1;
        var selected = '';
        if (cid) {
            $.ajax({
                type: 'GET',
                url: url,
                success: function (res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('<option value="">Select state</option>');
                        $.each(res, function (key, value) {
//                            if (stateId == value.id) {
//                                selected = "selected";
//                            } else {
//                                selected = '';
//                            }
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
        }
        var stateId = 1;
        var cityUrl = '{{ route("cities", ":id") }}';
        cityUrl = cityUrl.replace(':id', stateId);
        if (stateId) {
            $.ajax({
                type: 'GET',
                url: cityUrl,
                success: function (res) {
                    if (res)
                    {
                        $("#city").empty();
                        $("#city").append('<option value=""> Select city</option>');
                        $.each(res, function (key, value) {
//                            if (cityId == value.id) {
//                                selected = "selected";
//                            } else {
//                                selected = '';
//                            }
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
        }

    });
    $(document).ready(function () {

        var ticketNo = $('#free-no').val(); //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_ticket_button"); //Add button ID

        console.log('ticketNo', ticketNo);
        var x = 0; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            // e.preventDefault();

            var ticketNo = '';
            var price = '';
            var readonly = '';
            var ttype = '';
            if ($('#free-no').val() != '') {
                ticketNo = $('#free-no').val();
                price = 'free';
                readonly = "readonly";
                ttype = 'free';
            }
            if ($('#paid-no').val() != '') {
                ticketNo = $('#paid-no').val();
                ttype = 'paid';
            }
            console.log('aaa', ticketNo);

            for (x = 0; x < ticketNo; x++) { //max input box allowed
                //text box increment
                console.log('x', x);
                var tmp = $(wrapper).append('<div class="row"><div class="col-md-4 form-group cus-form-group">\n\
    <label for="image">Ticket Name</label>\n\
        <input type="text"  class="form-control ticketclass" required name="ticket_name[]" aria-describedby="emailHelp" placeholder="Ticket Name"></div>\n\
    <div class="col-md-4 form-group cus-form-group"><label for="image">Quantity available</label>\n\
        <input type="text"  class="form-control ticketclass" required name="quantity[]" aria-describedby="emailHelp" placeholder="Quantity available"></div>\n\
    <div class="col-md-2 form-group cus-form-group">\n\
    <label for="image">Price</label>\n\
        <input type="text"  class="form-control priceclass ticketclass" ' + readonly + ' value="' + price + '"  required name="price[]" aria-describedby="emailHelp" placeholder="Price"></div>\n\
    <div class="col-md-2 form-group cus-form-group">\n\
    <label for="image">Remove Ticket</label><a href="#" class="remove_field">Remove</a></div>\n\
    <div class="col-md-6 form-group cus-form-group">\n\
    <label for="image">Start Date</label>\n\
       <input type="date"  class="form-control datepicker_init ticketclass" name="ticket_start_date[]" required aria-describedby="emailHelp" placeholder="Start date"></div>\n\
    <div class="col-md-6 form-group cus-form-group"><label for="image">End Date</label>\n\
         <input type="date" class="form-control ticket_end_date datepicker_init ticketclass" required name="ticketend_date[]" aria-describedby="emailHelp" placeholder="End Date"></div>\n\
         <input type="hidden"  class="form-control" value="' + ttype + '" name="ticket_type[]" aria-describedby="emailHelp" placeholder="Price"></div>');
            }
            $('.addticketcheck').val('yes');
            $('#FreeModal').modal('hide');
            $('#paidModal').modal('hide');
//           reAddedpikkerDate();
        });
        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
            if (x == 0) {
                $('.addticketcheck').val('');
            }



        });
    });
    function openModal(par) {
        if (par == 'paid') {
            $('#paidModal').modal('show');
        }
        if (par == 'free') {
            $('#FreeModal').modal('show');
        }

        $('#ticketModal').modal('hide');
    }


    $(".datetimepicker").datetimepicker({
        format: 'm/d/Y H:i'
    });



    $(".datepicker").datetimepicker();
    CKEDITOR.replace('area1', {
        height: '20%',
        width: '100%'
    });
//bkLib.onDomLoaded(function() {
//        new nicEditor({ maxHeight : 100 }).panelInstance('area1');
//        
//        // new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
//        // new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
//        // new nicEditor({maxHeight : 100}).panelInstance('area5');
//});


    $('#country').change(function () {
        var cid = $(this).val();
        var url = '{{ route("states", ":id") }}';
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
        var ctyurl = '{{ route("cities", ":id") }}';
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

</script>
@endsection
@section('script-bottom')
@endsection