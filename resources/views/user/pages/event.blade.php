@extends('user.layouts.main')

@section('content')
 
<div id="event-page" class="banner breadcrumb">
    <div class="slider-content">
    <h4>Quick Events</h4>
    <h2>Search Event</h2>
    </div>
</div>
  
<div id="floating-search" class="container evnt">
  <h2>Event Browse</h2>
  <div class=" row">
    <div class="col-md-6">
    <div class="form-group">
      <input type="text" class="form-control" id="floatingInputGrid" placeholder="Enter KeyWord">
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
      <select class="form-control" id="event-cat">
      <option value="">Event Category</option>
      @foreach($allCategories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
      </select>
    </div>
    </div>
    <div class="col-md-2">
    <button type="submit" class="btn btn-primary">Search Event</button>
    </div>
  </div>
</div>
  

<div id="eve" class="events">
  <div class="container">
      <div class="row">

        <div class="filterr col-12" align="center">
          <button class="btn btn-default filter-button" data-filter="all">All</button>
          <button class="btn btn-default filter-button" data-filter="Recent">Most Recent</button>
          <button class="btn btn-default filter-button" data-filter="Free">Free Forms</button>
          <button class="btn btn-default filter-button" data-filter="Paid">Paid Forms</button>
        </div>
        <br/>

    @foreach($allEvents as $event)
    @php 
       $ticketType = [];
    @endphp

    @if(count($event->tickets) > 0)
      @foreach($event->tickets as $tic)
       @php 
        $ticketType[] = $tic->ticket_type;
       @endphp
      @endforeach
       
      @php 
       $ticketType = array_unique($ticketType);
      @endphp
    @endif

    <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Most Recent">
    <div class="tcard border-0 py-3 px-4">
      <div class="justify-content-center"> <img src="img/fe2.jpg" class="img-fluid profile-pic mb-4 mt-3"> </div>
      @php 
      $yrdata= strtotime($event->start_date);
      $startDate = date('d-M', $yrdata);
      @endphp
      <div class="fe-abs">
      <span class="date-abs">{{ $startDate }}</span>
      <div class="txt-card">
        <div class="event-name">
          <h2 class="titleh2 event-title">{{ $event->name }}</h2>
        <span class="tickets">Tickets From $45</span>
        </div>
        <p class="time-price"><span class="etime"><i class="far fa-clock"></i>  Start 20:00pm - 23:00pm</span> @foreach($ticketType as $tt) <span class="eprice">{{ $tt }}</span> @endforeach</p>
        <a class="btn btn-grad-bd ticket-details" href="#">Tickets & Details</a>
      </div>
      </div>
    </div>
    </div>

    @endforeach

    
    

    

    


      </div>
    </div>
  
  <script>
  $(document).ready(function(){

    $(".filter-button").click(function(){
      var value = $(this).attr('data-filter');
      
      if(value == "all")
      {
        //$('.filter').removeClass('hidden');
        $('.filter').show('1000');
      }
      else
      {
  //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
  //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
        $(".filter").not('.'+value).hide('3000');
        $('.filter').filter('.'+value).show('3000');
        
      }
    });
    
    if ($(".filter-button").removeClass("active")) {
  $(this).removeClass("active");
  }
  $(this).addClass("active");

  });
  </script>
</div>

@include('user.components.newsletter')
@include('user.components.trusted-brands')

@endsection