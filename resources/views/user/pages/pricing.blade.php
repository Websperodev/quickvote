@extends('user.layouts.main')

@section('content')
 
<div id="price-page" class="banner breadcrumb" style="background-image:url({!! isset($banners['img']) ? asset($banners['img']) : 'img/price.jpg' !!})">
  <div class="slider-content">
    <h4>{{ isset($banners['heading1']) ? $banners['heading1'] : 'Simple Pricing For Everyone' }}</h4>
    <h2>{{ isset($banners['heading2']) ? $banners['heading2'] : 'QuickVote Plans' }}</h2>
    <div class="lmore breadcrumb">
      <p>Home | <span>Pricing</span></p>
    </div>
  </div>
</div>
  
<div id="pricee" class="pricing">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="titleh2 tc">{{ isset($data['page_heading']) ? $data['page_heading'] :'Our Pricing'}}</h2>
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
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Support &amp; Monitoring</li>
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
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Support &amp; Monitoring</li>
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

  @include('user.components.trusted-brands')
  
@endsection