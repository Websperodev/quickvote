@extends('user.layouts.main')

@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    <div class="carousel-item active slide1">
      <div class="slider-content">
      <h4>Ever Wished For</h4>
      <h2>Transparent DigitalPolls?</h2>
      <p>Create a poll Contest in seconds. Your voters can vote from any location on any device.</p>
      <div class="lmore">
        <a href="#" class="btn btn-bg"> Learn More</a>
        <a href="#" class="btn btn-bd"> Get Started</a>
      </div>
      </div>
    </div>
    <div class="carousel-item slide1">
      <div class="slider-content">
      <h4>Ever Wished For</h4>
      <h2>Transparent DigitalPolls?</h2>
      <p>Create a poll Contest in seconds. Your voters can vote from any location on any device.</p>
      <div class="lmore">
        <a href="#" class="btn btn-bg"> Learn More</a>
        <a href="#" class="btn btn-bd"> Get Started</a>
      </div>
      </div>
    </div>
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
  
  <div id="floating-search" class="container">
    <h2>Browse Voting Contests</h2>
    <div class=" row">
      <div class="col-md-6">
      <div class="form-group">
        <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-search"></i></span></div>
        <input type="text" class="form-control" id="floatingInputGrid" placeholder="Search">
      </div>
      </div>
      <div class="col-md-4">
      <div class="form-group">
        <input type="date" class="form-control" id="inputDate" placeholder="Date">
      </div>
      </div>
      <div class="col-md-2">
      <button type="submit" class="btn btn-primary">Search Event</button>
      </div>
    </div>
  </div>
  
  <div id="feat" class="feat-event py-5">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="titleh2 tc">Featured Event</h2>
      <p>We support all types of poll events, here are some recent events created on our platform.</p>
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
      <div class="col-md-5"><img src="{{asset('img/aboutt.png')}}"></div>
      <div class="col-md-7">
        <h2 class="titleh2">About Quickvote</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. </p>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
      <a href="" class="btn btn-bg mt-4">Read More</a>
      </div>
    </div>
    </div>
  </div>
  
  <div class="pricing">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="titleh2 tc">Our Pricing</h2>
      <p>Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features. </p>
      <div class="cards row">
        <div class="col-6 card free">
        <div class="card-body">
          <h5 class="card-title text-muted text-uppercase text-center">FREEMIUM</h5>
          <h6 class="card-price text-center">50,000</h6>
          <p>One-time Contest fee</p>
          <hr>
          <ul class="fa-ul">
          <li><span class="fa-li"><i class="fas fa-check"></i></span>Instant Voting</li>
          <li><span class="fa-li"><i class="fas fa-check"></i></span>Support & Monitoring</li>
          <li><span class="fa-li"><i class="fas fa-times"></i></span>Voters Pays to Vote</li>
          <li><span class="fa-li"><i class="fas fa-check"></i></span>Result Exports</li>
          </ul>
          <a href="#" class="btn btn-block btn-primary text-uppercase">Create Freemium Contest</a>
        </div>
        </div>
        
        <div class="col-6 card paid">
        <div class="card-body">
          <h5 class="card-title text-uppercase text-center">Paid</h5>
          <h6 class="card-price text-center">20%</h6>
          <p>Service Charge Per Paid Vote</p>
          <hr>
          <ul class="fa-ul">
          <li><span class="fa-li"><i class="fas fa-check"></i></span>Instant Voting</li>
          <li><span class="fa-li"><i class="fas fa-check"></i></span>Support & Monitoring</li>
          <li><span class="fa-li"><i class="fas fa-check"></i></span>Voters Pays to Vote</li>
          <li><span class="fa-li"><i class="fas fa-check"></i></span>Result Exports</li>
          </ul>
          <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  
  <div id="tests">
    <div class="container text-center">
    <h2 class="titleh2 tc">What Our Client Say</h2>
    <p>Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features. </p>
    <div class="owl-carousel owl-theme">
      <div class="item first prev">
        <div class="tcard border-0 py-3 px-4">
          <div class="row justify-content-center"> <img src="{{asset('img/t1.png')}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
          <h6 class="mb-3 mt-2">Marielle Haag</h6>
          <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
        </div>
      </div>
      <div class="item show">
        <div class="tcard border-0 py-3 px-4">
          <div class="row justify-content-center"> <img src="{{asset('img/t2.png')}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
          <h6 class="mb-3 mt-2">Ximena Vegara</h6>
          <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
        </div>
      </div>
      <div class="item next">
        <div class="tcard border-0 py-3 px-4">
          <div class="row justify-content-center"> <img src="{{asset('img/t3.png')}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
          <h6 class="mb-3 mt-2">John Paul</h6>
          <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
        </div>
      </div>
      <div class="item last">
        <div class="tcard border-0 py-3 px-4">
          <div class="row justify-content-center"> <img src="{{asset('img/t2.png')}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
          <h6 class="mb-3 mt-2">William Doe</h6>
          <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
        </div>
      </div>
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
      <div class="slide"><img src="{{asset('img/1.png')}}"></div>
      <div class="slide"><img src="{{asset('img/2.png')}}"></div>
      <div class="slide"><img src="{{asset('img/3.png')}}"></div>
      <div class="slide"><img src="{{asset('img/4.png')}}"></div>
      <div class="slide"><img src="{{asset('img/5.png')}}"></div>
      <div class="slide"><img src="{{asset('img/6.png')}}"></div>
      <div class="slide"><img src="{{asset('img/7.png')}}"></div>
    </div>    
    </div>

    <script>
    $(document).ready(function(){
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
@endsection