@extends('user.layouts.main')
@section('content')
<style>
    .brands .slick-slide{
        height:30% !important;
    }
</style>
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
                    <h5>Tickets</h5>
                    @if(!empty($ticket))
                    @foreach($ticket as $tik)
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
                        <span class="tkt-name">{{$tik->name}} <span class="tkt-price">{{($tik->price)}}</span><span class="abs">{{$status}}</span>  <span class="tkt-quantity"><input class="form-control" type="number"></span>
                    </p>
                    @endforeach
                    @endif
                    <p class="buy-tkt"><a href="" class="btn vtn-success">Buy Ticket(s)</a></p>
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

@include('user.components.newsletter')
@include('user.components.trusted-brands')

@endsection