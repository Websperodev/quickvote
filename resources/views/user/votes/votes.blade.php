@extends('user.layouts.main')

@section('content')
<style>
    .brands .slick-slide{
        height:30% !important;
    }
</style>
<div id="event-page" class="banner breadcrumb">
    <div class="slider-content">
        <h4>Voting Contests</h4>

    </div>
</div>

<div id="floating-search" class="container evnt">
    <h2>Browse Voting Contests</h2>
    <div class=" row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" id="floatingInputGrid" placeholder="Enter KeyWord">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="date" class="form-control" id="inputDate" placeholder="Date">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</div>

<div id="eve" class="events">
    <div class="container">
        <div class="row">
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
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Most Recent">
                <div class="tcard border-0 py-3 px-4">
                    <div class="justify-content-center"> <img src="{{url($img)}}" class="img-fluid profile-pic mb-4 mt-3" > </div>
                    <div class="fe-abs">
                        <span class="date-abs">Vote</span>
                        <div class="txt-card">
                            <div class="event-name">
                                <h2 class="titleh2 event-title">{{$voting->title}}</h2>

                            </div>
                            <p class="time-price"><span class="etime"><i class="far fa-clock"></i> Start {{$start_day .' '.$start_month. ' '.$start_date.' '.$start_year .' - '.$close_day.' '.$close_month.' '.$clos_date}}</span> </p>
                            <a class="btn btn-grad-bd ticket-details" href="{{url('contestants').'/'.$voting->id}}">Contestants</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
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
