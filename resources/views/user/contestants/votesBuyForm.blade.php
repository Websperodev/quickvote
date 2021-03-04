@extends('user.layouts.main')

@section('content')

<style>
    .brands .slick-slide{
        height:30% !important;
    }
    .error{
        color:red;
    }
    .vote-price{
        color:red; 
    }
</style>

<div id="cand-detail" class="candid">
    <div class="container">
        @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}"> 
            {!! session('message.text') !!}
        </div>
        @endif
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
            if($char >500){
            $description=$description.'...';
            }

            @endphp
            <div class="col-md-8 col-sm-12 edetail">
                <div class="event-titlee">
                    <div class="eve-img"><img src="{{url($img)}}"></div>
                    <div class="eve-title">
                        <h2>{{$event->name }}</h2>
                        <p class="eve-date-time"><span class="eve-date">Date: {{$start_day .' '.$start_month .' '.$start_date.' '.$start_year}}</span> <span class="eve-time">Time: {{$start_time}}</span></p>
                    </div>
                </div>
                <div class="event-details"> <br> <br>
                    <div class="eve-description">
                        <div><h4>Location</h4> <span>{{$event->country->name}}</span></div>
                        <div><h4>Date & Time</h4> <span>{{$start_day.' '.$start_month.' '.$start_date. ' '.$start_year}}, Time:{{$start_time}}</span></div>
                        <div><h4>Event Details</h4> 
                            <span>{{$description}}</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 sidebar">			
                <div class="candidate-vote">
                    <img src="{{url($img)}}" class="cand-pic">
                    <h5>Vote Form</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    {!! Form::open(array('route' => 'contestants.buyvotes.save', 'id' => 'buy_votes_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}

                    @csrf
                    <div class="col-md-12">
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <input type="hidden" name="contestant_id" value="{{$contestants->id}}" >
                        <div class="form-group">
                            <input type="Number" name="votes" value="" class="form-control" placeholder="Enter the total number of votes you">
                            @if($errors->has('votes'))
                            <div class="error">{{ $errors->first('votes') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" value="" class="form-control" placeholder="Enter your full name">
                            @if($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="" class="form-control" placeholder="Enter valid email for your receipt">
                            @if($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" value="" class="form-control" placeholder="Enter your phone number">
                            @if($errors->has('phone'))
                            <div class="error">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                    </div>
                    <p class="vote-price">Each Vote costs <span>0.282 USD</span></p>
                    <p class="vote-payment"><button type="submit" class="btn btn-bg">Proceed To Payment</button></p>
                    {!! Form::close() !!}
                </div>

            </div>
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
</div>
<script>
    $(document).ready(function () {

        $(".filter-button").click(function () {
            var value = $(this).attr('data-filter');

            if (value == "all")
            {
                //$('.filter').removeClass('hidden');
                $('.filter').show('1000');
            } else
            {
                //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
                //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                $(".filter").not('.' + value).hide('3000');
                $('.filter').filter('.' + value).show('3000');

            }
        });

        if ($(".filter-button").removeClass("active")) {
            $(this).removeClass("active");
        }
        $(this).addClass("active");

    });
</script>


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

    <script>
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
        });
    </script>
</div>

