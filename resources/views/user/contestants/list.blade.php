@extends('user.layouts.main')

@section('content')

<style>
    .brands .slick-slide{
        height:30% !important;
    }

</style>
<script>
    var url = "{{url('contestants').'/'.$event->id}}";
</script>

<div id="eve-detail" class="event-contestant">
    <div class="container">
        <div class="row">
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
            <div class="col-md-8 col-sm-12 edetail">
                <div class="event-titlee">
                    <div class="eve-img"><img src="{{url($img)}}" ></div>
                    <div class="eve-title">
                        <h2>{{$event->name }}</h2>
                        <p class="eve-date-time"><span class="eve-date">Date: {{$start_day .' '.$start_month .' '.$start_date.' '.$start_year}}</span> <span class="eve-time">Time: {{$start_time}}</span></p>
                    </div>
                </div>
                <div class="event-details">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#candidate">Candidate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#organizer">Organizer</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="candidate" class="tab-pane active">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control cont_id" name="cont_id" >
                                        <option value=""> Select Contestant</option>
                                        @if(!empty($contestants))
                                        @foreach($allContestants as $cont)

                                        <option value="{{$cont->id}}"> {{$cont->name}}</option>
                                        <option {{ $constnt_id == $cont->id ? 'selected' : ''}}  value="{{ $cont->id }}">{{ $cont->name }}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-bg">Search Event</button>
                            </div>
                        </div>
                        <div id="organizer" class="tab-pane fade">
                            <div class="eve-description">
                                <div><h4>Location</h4> <span>{{$event->country->name}}</span></div>
                                <div><h4>Date & Time</h4> <span>{{$start_day.' '.$start_month.' '.$start_date. ' '.$start_year}}, Time:{{$start_time}}</span></div>
                                <div><h4>Event Details</h4> 
                                    <span>{{$description}}</span></div>
                            </div>
                        </div>
                    </div> 			  
                </div>
            </div>
            <div class="col-md-4 col-sm-12 sidebar">
                <div class="single-event-ticket">
                    <img src="{{url($img)}}">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cand" class="events candidatelists">
    <div class="container">
        <div class="row">
            @if(!empty($contestants))
            @foreach($contestants as $cont)
            @php  if($cont->image != '')
            {
            $cImg = $cont->image;
            }
            else{
            $cImg ="img/fe2.jpg";
            }
            @endphp
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 candidates">
                <div class="tcard border-0 py-3 px-4">
                    <div class="justify-content-center"> <img src="{{url($cImg)}}" class="img-fluid cand-pic mt-3"> </div>
                    <div class="can-detail">
                        <div class="txt-card">
                            <div class="event-name">
                                <h2 class="cand-name">{{$cont->name}}</h2>
                                <span class="cand-no">Candidate Number: <span>{{ $cont->candidate_id}}<span></span>
                                        </div>
                                        <div class="votez"><span class="vote-result">Vote Result: <span>{{$cont->percentage}}%</span></span> <span class="vote-btn"><a href="#" class="btn btn-bg">Vote</a></span></div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>

                                        @endforeach
                                        @endif
                                        </div>
                                        </div>
                                        </div>

                                        <div id="eve" class="events single-eve">
                                            <div class="container">
                                                <div class="row">
                                                    <h2 class="titleh2 tc">Similar Events</h2>
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
                                                    <p align="center"> <a href="{{url('search-event')}}" class="btn btn-bg mt-4">View All Events</a></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cta py-5">
                                            <div class="container">
                                                <div class="row vcenter">
                                                    <div class="col-md-7">
                                                        <h2 class="titleh2">News and  Updates</h2>
                                                        <p>Subscribe to our newsletter and receive the latest news from QuickVote.</p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <form class="subs">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="newsletter" placeholder="Enter Your Email">
                                                                <button type="submit" class="btn btn-primary nletter">Subscribe</button>
                                                            </div>			
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="brands py-5 my-3">
                                            <div class="container">
                                                <h2 class="titleh2 tc">Trusted By Great Brands In Nigeria</h2>
                                                <div class="customer-logos">
                                                    <div class="slide"><img src="{{url('img/1.png')}}"></div>
                                                    <div class="slide"><img src="{{url('img/2.png')}}"></div>
                                                    <div class="slide"><img src="{{url('img/3.png')}}"></div>
                                                    <div class="slide"><img src="{{url('img/4.png')}}"></div>
                                                    <div class="slide"><img src="{{url('img/5.png')}}"></div>
                                                    <div class="slide"><img src="{{url('img/6.png')}}"></div>
                                                    <div class="slide"><img src="{{url('img/7.png')}}"></div>
                                                </div>		
                                            </div>
                                            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                                            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

                                            <script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
                                            <script>
    $('.cont_id').on('change', function () {
        var cont_id = $('.cont_id').val();
        var curl = url + '?cId=' + cont_id;

        window.location.replace(curl);
//            alert(cont_id);
//    window.redirect();
    });
    $(document).ready(function () {




        $('.customer-logos').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover: true,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 2
                    }
                }]
        });
    }
    );
                                            </script>
                                        </div>
