@extends('user.layouts.main')

@section('content')
  
<div id="team-page" class="banner breadcrumb"  style="background-image:url({!! isset($banners['img']) ? asset($banners['img']) : 'img/price.jpg' !!})">
    <div class="slider-content">
    <h4>{{ isset($banners['heading1']) ? $banners['heading1'] : 'Quickvote Team' }}</h4>
    <h2>{{ isset($banners['heading1']) ? $banners['heading1'] : 'Our Team' }}</h2>
    <div class="lmore breadcrumb">
      <p>Home | <span>About Us - Team</span></p>
    </div>
    </div>
  </div>
  
  <div id="team" class="our-team py-5">
    <div class="container text-center">
    <h2 class="titleh2 tc">{!! isset($pageData['our-team']['heading1']) ? $pageData['our-team']['heading1'] : 'Our Awesome Team' !!}</h2>
    <p>{!! isset($pageData['our-team']['description']) ? $pageData['our-team']['description'] : 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.' !!}  </p>
    
    @if(count($teamMember) == 2)
    <div class="container team2">
        <div class="row">
          <div class="col-12">
            @foreach($teamMember as $k => $team)
            <div class="col-6">
              <div class="team-mem">
                <span><img src="{!! url($team->image) !!}" class="img-fluid profile-pic mb-4 mt-3"></span>
                <h3>{!! $team->name !!}</h3>
                <h4>{!! $team->designation !!}</h4>
                <p class="follow-mem tc"><a href="#"><i class="fab fa-linkedin-in"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-facebook-f"></i></a> <a href="#"><i class="fab fa-instagram"></i></a> </p>
              </div>
            </div>
            @endforeach

          </div>
        </div>  
    </div>
    @else
    <div class="owl-carousel owl-theme">

      @foreach($teamMember as $k => $team)
      <div class="item {{($k == 0) ? 'first' : ''}}">
        <div class="team-mem">
          <span><img src="{!! url($team->image) !!}" class="img-fluid profile-pic mb-4 mt-3"></span>
          <h3>{!! $team->name !!}</h3>
          <h4>{!! $team->designation !!}</h4>
          <p class="follow-mem tc"><a href="#"><i class="fab fa-linkedin-in"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-facebook-f"></i></a> <a href="#"><i class="fab fa-instagram"></i></a> </p>
        </div>
      </div>
      @endforeach
      <!-- <div class="item show">
      <div class="team-mem">
        <img src="img/team.jpg" class="img-fluid profile-pic mb-4 mt-3">
        <h3>Scarlett Snow</h3>
        <h4>Designer at Startup</h4>
        <p class="follow-mem tc"><a href="#"><i class="fab fa-linkedin-in"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-facebook-f"></i></a> <a href="#"><i class="fab fa-instagram"></i></a> </p>
      </div>
      </div>
      <div class="item next">
      <div class="team-mem">
        <img src="img/team.jpg" class="img-fluid profile-pic mb-4 mt-3">
        <h3>Scarlett Snow</h3>
        <h4>Designer at Startup</h4>
        <p class="follow-mem tc"><a href="#"><i class="fab fa-linkedin-in"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-facebook-f"></i></a> <a href="#"><i class="fab fa-instagram"></i></a> </p>
      </div>
      </div>
      <div class="item last">
      <div class="team-mem">
        <img src="img/team.jpg" class="img-fluid profile-pic mb-4 mt-3">
        <h3>Scarlett Snow</h3>
        <h4>Designer at Startup</h4>
        <p class="follow-mem tc"><a href="#"><i class="fab fa-linkedin-in"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-facebook-f"></i></a> <a href="#"><i class="fab fa-instagram"></i></a> </p>
      </div>
      </div> -->

    </div>

    @endif

    </div>
  
  </div>
  
  <div id="invest" class="investor dark-bg py-5">
    <div class="container">
    <div class="row">
      <div class="col-12">
      <h2 class="titleh2 tc">{!! isset($pageData['our-investors']['heading1']) ? $pageData['our-investors']['heading1'] : 'Our Investors' !!}</h2>
      <p>{!! isset($pageData['our-investors']['description']) ? $pageData['our-investors']['description'] : 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features. Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features. Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features. Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.' !!} </p>
      </div>
    </div>
    </div>
  </div>

  @include('user.components.testimonial')
  @include('user.components.newsletter')
  @include('user.components.trusted-brands')
  
@endsection