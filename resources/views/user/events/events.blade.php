@extends('user.layouts.main')
@section('content')
<style>
    .brands .slick-slide{
        height:30% !important;
    }
</style>
<script>
    var userStats = "{{$userStatus}}";
    var totalticketPrice = 0;</script>

<div id="eve-detail" class="single-event">
    <div class="container">
        <div class="row">
            @if(!empty($event))
            <div class="col-md-8 col-sm-12 edetail">
                <div class="event-titlee">

                    @php

                    if($event->image != '')
                    {
                    $img = $event->image;
                    }
                    else{
                    $img ="img/fe2.jpg";
                    }
                    $date = $event->start_date;

                    $start_day=date('D', strtotime($date));
                    $start_month=date('F', strtotime($date));
                    $start_month_shot=date('m', strtotime($date));
                    $start_date=date('d',strtotime($date));
                    $start_year=date('Y',strtotime($date));
                    $start_time=date('h:m',strtotime($date));
                    $description=substr(strip_tags($event['description']),0, 150);
                    $char=strlen($event['description']);
                    if($char >150){
                    $description=$description.'...';
                    }

                    @endphp
                    <div class="eve-img"><img src="{{url($img)}}"></div>
                    <div class="eve-title">
                        <h2>{{$event->name}}</h2>
                        <p class="eve-date-time"><span class="eve-date">Date: {{$start_day.' '.$start_month.' '.$start_date. ' '.$start_year}} </span> <span class="eve-time">Time: {{$start_time}}</span></p>
                    </div>
                </div>
                <div class="event-details">
                    <img src="{{url($img)}}">
                    <div class="eve-description">
                        <div><h4>Location</h4> <span>{{$event->country->name}}</span></div>
                        <div><h4>Date & Time</h4> <span>{{$start_day.' '.$start_month.' '.$start_date. ' '.$start_year}}, Time:{{$start_time}}</span></div>
                        <div><h4>Event Details</h4> 
                            <span>{{$description}}</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 sidebar">
                <div class="single-event-ticket">
                    @if(!empty($ticket))
                    <h5>Tickets</h5>

                    <script>

                        var tktlan = "{{count($ticket)}}";
                    </script>
                    <!--<form id="ticket_form" action="{{route('tickets.buy')}}" method="post">-->
                    <form id="ticket_form"  method="post">
                        <script src="https://js.paystack.co/v1/inline.js"></script>
                        @csrf
                        @foreach($ticket as $key=>$tik)
                        @php 
                        $endDt=strtotime($tik->end_date);
                        $currtDt=strtotime($crruntDate);

                        if($endDt >= $currtDt){
                        $status='';
                        }else{
                        $status='Closed';
                        }
                        @endphp

                        <p class="tkt">
                            <span class="tkt-name">{{$tik->name}} <span class="tkt-price">{{($tik->price)}}</span><span class="abs">{{$status}}</span> 
                                <span class="tkt-quantity">
                                    <input class="form-control numberOfTicket quantity" id="ticket{{$key}}" name="number[]" data-value="{{($tik->price)}}" data-amount="0" value="" type="number"></span>
                                <input type="hidden" name="tktId[]" value="{{($tik->id)}}" >
                                <input type="hidden" name="evntId[]" value="{{($tik->event_id)}}" >
                                <input type="hidden"  name="single_amount[]" value="{{($tik->price)}}" >
                                <input type="hidden"  name="type[]" value="{{($tik->type)}}" >

                                </p>
                                @endforeach
                                <input type="hidden" class="totalAmount" name="total_amount" value="" >
                                <input type="hidden" name="reference" value="" id="reference">
                                <input type="hidden" name="trans" value="" id="trans">
                                <input type="hidden" name="status" value="" id="status">
                                <input type="hidden" name="transaction" value="" id="transaction">

                                <p id="totalAmount" style="color:red;"></p>
                                <p class="buy-tkt"><button type="button" onclick="payWithPaystack()" class="btn vtn-success">Buy Ticket(s)</button></p>
                    </form>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<div id="eve" class="events single-eve">
    <div class="container">
        <div class="row">
            @if(!empty($sugstEvent))
            @foreach($sugstEvent as $sugg)
            @php 
            if($sugg['image'] != '')
            {
            $simg = $sugg['image'];
            }
            else
            {
            $simg ="img/fe2.jpg";
            }
            $date = $sugg['start_date'];
            $start_day=date('D', strtotime($date));
            $start_month=date('F', strtotime($date));
            $start_month_shot=date('M', strtotime($date));
            $start_date=date('d',strtotime($date));
            $start_year=date('Y',strtotime($date));
            $start_time=date('h:i:A',strtotime($date));
            $end_time=date('h:i:A',strtotime($sugg['end_date']));

            if(isset($sugg['tickets']) && !empty($sugg['tickets'])){
            $price=$sugg['tickets'][0]['price'];
            $ticket_type=$sugg['tickets'][0]['ticket_type'];
            }
            else{
            $price='';
            $ticket_type='';
            }
            @endphp
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Most Recent">
                <div class="tcard border-0 py-3 px-4">
                    <div class="justify-content-center"> <img src="{{url($simg)}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
                    <div class="fe-abs">
                        <span class="date-abs">{{$start_date .' '. $start_month_shot}}</span>
                        <div class="txt-card">
                            <div class="event-name">
                                <h2 class="titleh2 event-title">{{$sugg['name']}}</h2>
                                <span class="tickets">Tickets From {{$price}}</span>
                            </div>
                            <p class="time-price"><span class="etime"><i class="far fa-clock"></i> Start {{$start_time .'-'.$end_time}}</span> <span class="eprice">{{$ticket_type}}</span></p>
                            <a class="btn btn-grad-bd ticket-details" href="{{url('event-detail').'/'.$sugg['id']}}">Tickets & Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <p align="center"> <a href="{{url('categories-list')}}" class="btn btn-bg mt-4">View All Categories</a></p>
        </div>
    </div>
</div>
<script>
    $(".quantity").keyup(function () {
        var quantity = $(this).val();
        if (quantity < 1) {
            $(this).val('');
        }
    })
</script>
<script>

    $('.numberOfTicket').keyup(function (e) {
        var quantity = 0;
        var sum = 0;
        var qty = $(this).val();
        var amt = 0;
        var amts = $(this).data('value');
        if (amts == 'free') {
            amt = 0;
        } else {
            amt = amts;
        }
        var total = qty * amt;
        $(this).attr('data-amount', total);
        $('.numberOfTicket').each(function (d, f) {
//            console.log("############",d,f)
            var sum1 = $("#ticket" + d).attr("data-amount")
            sum = sum + parseInt(sum1);
        });
//         console.log(quantity);
        totalticketPrice = sum;
        $("#totalAmount").text(sum);
    });
    function payWithPaystack() {

        var url = "{{url('event-tickets-buy')}}";
        var amount = totalticketPrice;
        if (userStats == 'yes') {


            if (amount && amount != '') {
                var handler = PaystackPop.setup({
                    key: 'pk_test_402e4abb808a62fc2ba080d79887f256cb5c574a',
                    email: 'dilpreet@webspero.com',
                    amount: amount * 100,
                    ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    metadata: {
                        custom_fields: [
                            {
                                display_name: "Mobile Number",
                                variable_name: "mobile_number",
                                value: "+2348012345678"
                            }
                        ]
                    },
                    callback: function (response) {
                        $('#reference').val(response.reference);
                        $('#trans').val(response.trans);
                        $('#status').val(response.status);
                        $('#transaction').val(response.transaction);
                        var myData = $("#ticket_form").serializeArray();
                        $.ajax({
                            url: url,
                            type: "post",
                            data: myData,
                            success: function (res) {
                                if (res.status == 1) {
                                    Swal.fire({
                                        type: 'Success',
                                        title: 'Success!',
                                        text: res.message,
                                        confirmButtonClass: 'btn btn-confirm mt-2',
                                    });
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Error!',
                                        text: 'You cannot buy event tickets',
                                        confirmButtonClass: 'btn btn-confirm mt-2',
                                    });
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                    },
                    onClose: function () {
                    }
                });
                handler.openIframe();
            } else {
//            alert('dfjhjfd');
                var myData = $("#ticket_form").serializeArray();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: myData,
                    dataType: "json",
                    success: (function (success) {
                        if (success.status == 1) {
                            Swal.fire({
                                type: 'Success',
                                title: 'Success!',
                                text: success.message,
                                confirmButtonClass: 'btn btn-confirm mt-2',
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: 'You cannot buy event tickets',
                                confirmButtonClass: 'btn btn-confirm mt-2',
                            });
                        }
                    })
                });
            }
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error!',
                text: 'You have to login then can be buy the tickets',
                confirmButtonClass: 'btn btn-confirm mt-2',
            });
        }
    }
</script>
@include('user.components.newsletter')
@include('user.components.trusted-brands')

@endsection