@extends('user.layouts.main')

@section('content')
 
<div id="price-page" class="banner breadcrumb" style="background-image:url({!! isset($banners['img']) ? $banners['img'] : 'img/price.jpg' !!})">
  <div class="slider-content">
    <h4>{{ isset($banners['heading1']) ? $banners['heading1'] : 'Quickvote Services' }}</h4>
    <h2>{{ isset($banners['heading2']) ? $banners['heading2'] : 'Our Services' }}</h2>
    <div class="lmore breadcrumb">
      <p>Home | <span>Pricing</span></p>
    </div>
  </div>
</div>
  
<div id="serv" class="services srv-page">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="titleh2 tc">{!! isset($serviceData['heading1']) ? $serviceData['heading1'] : 'Our Services' !!}</h2>
      <p>{!! isset($serviceData['description']) ? $serviceData['description'] : 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features' !!}  </p>
      
      <div class="service-sec row">
        @foreach($services as $service)
          <div class="col-4 serv">
          <div class="serv-body">
            <img class="o-img" src="{!! ucfirst($service->image) !!}">
            <h3 class="titleh3 tc">{!! ucfirst($service->name) !!}</h3>
            <p>{!! ucfirst($service->text) !!}</p>
          </div>
          </div>
        @endforeach
        
        <!-- <div class="col-4 serv2">
        <div class="serv-body">
          <img class="o-img" src="img/abt3.png">
          <img class="w-img" src="img/abt3w.png">
          <h3 class="titleh3 tc">Easy to use</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
        </div>
        </div>
        
        <div class="col-4 serv3">
        <div class="serv-body">
          <img class="o-img" src="img/abt1.png">
          <img class="w-img" src="img/abt1w.png">
          <h3 class="titleh3 tc">Accessibilty</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
        </div>
        </div>
        
        <div class="col-4 serv4">
        <div class="serv-body">
          <img class="o-img" src="img/abt6.png">
          <img class="w-img" src="img/abt6w.png">
          <h3 class="titleh3 tc">Transparency</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
        </div>
        </div>
        
        <div class="col-4 serv5">
        <div class="serv-body">
          <img class="o-img" src="img/abt3.png">
          <img class="w-img" src="img/abt3w.png">
          <h3 class="titleh3 tc">Easy to use</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
        </div>
        </div>
        
        <div class="col-4 serv6">
        <div class="serv-body">
          <img class="o-img" src="img/abt1.png">
          <img class="w-img" src="img/abt1w.png">
          <h3 class="titleh3 tc">Accessibilty</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
        </div>
        </div> -->
        
      </div>
      </div>
    </div>
    </div>
  </div>

  @include('user.components.testimonial')
  @include('user.components.newsletter')
  @include('user.components.trusted-brands')
  
@endsection