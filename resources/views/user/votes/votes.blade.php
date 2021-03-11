@extends('user.layouts.main')
@section('content')
<div id="event-page" class="banner breadcrumb">
  <div class="slider-content">
    <h4>Quick Events</h4>
    <h2>Search Event</h2>
  </div>
</div>
    
<div id="floating-search" class="container evnt">
    <h2>Browse Voting Contests</h2>
    <div class=" row">
        <div class="col-md-10">
            <div class="form-group">
                <input type="text" class="form-control" id="floatingInputGrid" placeholder="Enter KeyWord">
            </div>
        </div>
        
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</div>

<div id="eve" class="events voting-page">
  <div class="container">
    <div class="row">
        

      <div class="filterr col-12" align="center">
        <button class="btn btn-default filter-button" data-filter="all">All</button>
        <button class="btn btn-default filter-button" data-filter="Recent">Most Recent</button>
        <button class="btn btn-default filter-button" data-filter="Free">Free Forms</button>
        <button class="btn btn-default filter-button" data-filter="Paid">Paid Forms</button>
      </div>
      <br/> 

       @if(!empty($voting_contest))
            @foreach($voting_contest as $voting)
            @php

            if($voting->image != '')
            {
            $img = $voting->image;
            }
            else{
            $img ="img/fe2.jpg";
            }
            $date = $voting->starting_date;
            $close_date = $voting->closing_date;

            $start_day=date('D', strtotime($date));
            $start_month=date('F', strtotime($date));
            $start_month_shot=date('m', strtotime($date));
            $start_date=date('d',strtotime($date));
            $start_year=date('Y',strtotime($date));
            $start_time=date('h:m',strtotime($date));

            $close_day=date('D', strtotime($close_date));
            $close_month=date('F', strtotime($close_date));
            $close_month_shot=date('m', strtotime($close_date));
            $clos_date=date('d',strtotime($close_date));
            $close_year=date('Y',strtotime($close_date));
            $close_time=date('h:m',strtotime($close_date));


            @endphp

      <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Paid">
        <div class="tcard border-0 py-3 px-4">
          <div class="justify-content-center"> <img src="{{url($img)}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
          <div class="fe-abs">
            <span class="date-abs">30 June</span>
            <div class="txt-card">
              <div class="event-name">
                <h2 class="titleh2 event-title">{{$voting->title}}</h2>
                <span class="tickets">Tickets From $45</span>
              </div>
              <p class="time-price"><span class="etime"><i class="far fa-clock"></i> Start {{$start_day .' '.$start_month. ' '.$start_date.' '.$start_year .' - '.$close_day.' '.$close_month.' '.$clos_date}}</span> </p>
            <a class="btn btn-grad-bd ticket-details" href="{{url('contestants').'/'.$voting->id}}">View contest</a>
            </div>
          </div>
        </div>
      </div>
       @endforeach
            @endif

     

     

     
    </div>
  </div>
 
</div>
    
@include('user.components.newsletter')
@include('user.components.trusted-brands')

@endsection