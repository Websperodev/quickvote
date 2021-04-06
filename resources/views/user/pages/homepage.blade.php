@extends('user.layouts.main')

@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @if(isset($sliders['home']) && !empty($sliders['home']))
        @foreach($sliders['home'] as $k => $slider)
        <div class="carousel-item @if($k == '0') active  @endif slide1" style="background-image:url({!! asset("$slider->img1") !!})">
            <div class="slider-content">
                <h4>{!! $slider['heading1'] !!}</h4>
                <h2>{!! $slider['heading2'] !!}</h2>
                <p>{!! $slider['description'] !!}</p>
                <div class="lmore">
                    <a href="#" class="btn btn-bg"> Learn More</a>
                    <a href="#" class="btn btn-bd"> Get Started</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>

    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="prev-icon" aria-hidden="true"><img src="{{asset('img/prev.png')}}"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="next-icon" aria-hidden="true"><img src="{{asset('img/next.png')}}"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>

<!--<div id="floating-search" class="container">
    <h2>Browse Voting Contests</h2>
    <form action="{{url('categories-list')}}" method="POST" id="seachform">
        @csrf
        <div class=" row">

            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-search"></i></span></div>
                    <input type="text" class="form-control seachName" onkeyup="checksearchInput()" name="eventname" value="" id="floatingInputGrid" placeholder="Search">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="date" class="form-control seachDate" onchange="checksearchInput()" name="eventDate" value="" id="inputDate" placeholder="Date">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary seachButton" disabled>Search Event</button>
            </div>

        </div>
    </form>
</div>-->


<div id="feat" class="feat-event py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="titleh2 tc">{!! isset($pageData['featured event']['heading1']) ? ucfirst($pageData['featured event']['heading1']) : '' !!}</h2>
                <p> {!! isset($pageData['featured event']['description']) ? ucfirst($pageData['featured event']['description']) : 'We support all types of poll events, here are some recent events created on our platform.' !!} </p>
                <div class="owl-carousel owl-theme">
                    <div class="item first prev">
                        <div class="tcard border-0 py-3 px-4">
                            <div class="row justify-content-center"> <img src="{{asset('img/fe1.jpg')}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
                            <div class="fe-abs">
                                <span class="date-abs">30 June</span>
                                <div class="txt-card">
                                    <h2 class="titleh2 event-title">Miss EntrePreneurship 2020</h2>
                                    <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
                                    <a class="btn btn-bg view-contest" href="#">View Contest</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item show">
                        <div class="tcard border-0 py-3 px-4">
                            <div class="row justify-content-center"> <img src="{{asset('img/fe2.jpg')}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
                            <div class="fe-abs">
                                <span class="date-abs">30 June</span>
                                <div class="txt-card">
                                    <h2 class="titleh2 event-title">Miss EntrePreneurship 2020</h2>
                                    <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
                                    <a class="btn btn-bg view-contest" href="#">View Contest</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item next">
                        <div class="tcard border-0 py-3 px-4">
                            <div class="row justify-content-center"> <img src="{{asset('img/fe3.jpg')}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
                            <div class="fe-abs">
                                <span class="date-abs">30 June</span>
                                <div class="txt-card">
                                    <h2 class="titleh2 event-title">Miss EntrePreneurship 2020</h2>
                                    <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
                                    <a class="btn btn-bg view-contest" href="#">View Contest</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item last">
                        <div class="tcard border-0 py-3 px-4">
                            <div class="row justify-content-center"> <img src="{{asset('img/fe2.jpg')}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
                            <div class="fe-abs">
                                <span class="date-abs">30 June</span>
                                <div class="txt-card">
                                    <h2 class="titleh2 event-title">Miss EntrePreneurship 2020</h2>
                                    <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
                                    <a class="btn btn-bg view-contest" href="#">View Contest</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>


<div id="about">
    <div class="container">
        <div class="row vcenter">
            <div class="col-md-5"><img src="{{ isset($pageData['about quickvote']['img1']) ? url($pageData['about quickvote']['img1']) : asset('img/aboutt.png') }}"></div>
            <div class="col-md-7">
                <h2 class="titleh2">{!! isset($pageData['about quickvote']['heading1']) ? ucfirst($pageData['about quickvote']['heading1']) : 'About Quickvote' !!}</h2>
                <p> {!! isset($pageData['about quickvote']['description']) ? ucfirst($pageData['about quickvote']['description']) : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. </p>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>' !!}

                <a href="" class="btn btn-bg mt-4">Read More</a>
            </div>
        </div>
    </div>
</div>


@include('user.components.pricing-plans')
@include('user.components.testimonial')
@include('user.components.newsletter')
@include('user.components.trusted-brands')
<script>
    function checksearchInput() {
        var name = $('.seachName').val();
        var date = $('.seachDate').val();
        if (name != '' || date != '') {
            $('.seachButton').prop('disabled', false);

        } else {
            $('.seachButton').prop('disabled', true);
        }
    }

</script>
@endsection