@extends('user.layouts.main')

@section('content')
 
  <div id="carouselabt1" class="abt-page carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    <div class="carousel-item active slide1">
      <div class="slider-content">
      <h4>All You Need To Know</h4>
      <h2>About QuickVote</h2>
      <p>Create a poll Contest in seconds. Your voters can vote from any location on any device.</p>
      <div class="lmore breadcrumb">
        <p>Home | <span>About US</span></p>
      </div>
      </div>
    </div>
    
    </div>
    
  </div>
  
  <div id="about" class="about-page">
    <div class="container">
    <div class="row vcenter">
      <div class="col-md-5"><img src="{!! $pageData['aboutus']['about quickvote']['img1'] !!}"></div>
      <div class="col-md-7">
        <h2 class="titleh2">{!! isset($pageData['aboutus']['about quickvote']['heading1']) ? ucfirst($pageData['aboutus']['about quickvote']['heading1']) : 'About Quickvote' !!}</h2>
      <p>{!! isset($pageData['aboutus']['about quickvote']['description']) ? ucfirst($pageData['aboutus']['about quickvote']['description']) : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. </p>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>' !!}
      <a href="" class="btn btn-bg mt-4">Read More</a>
      </div>
    </div>
    </div>
  </div>
  
  <div id="serv" class="services">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="titleh2 tc">{!! isset($pageData['aboutus']['our services']['heading1']) ? ucfirst($pageData['aboutus']['our services']['heading1']) : 'Our Services' !!} </h2>
      <p>{!! isset($pageData['aboutus']['our services']['description']) ? ucfirst($pageData['aboutus']['our services']['description']) : 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.' !!}  </p>
      <div class="service-sec row">
        @if(isset($services['top']) && !empty($services['top']))
          @foreach($services['top'] as $service)
          <div class="col-4 serv">
          <div class="serv-body">
            <img class="o-img" src="img/abt6.png">
            <img class="w-img" src="img/abt6w.png">
            <h3 class="titleh3 tc">{!! $service->name !!}</h3>
            <p>{!! $service->text !!}</p>
          </div>
          </div>
          @endforeach
        @endif
        
      
      </div>
      </div>
    </div>
    </div>
  </div>
  
  <div id="create" class="py-5">
    <div class="container">
    <div class="row vcenter">
      <div class="col-md-5"><img src="url({{ $pageData['aboutus']['dedicated']['img1'] }}) "></div>
      <div class="col-md-7">
        <h2 class="titleh2"> {!! isset($pageData['aboutus']['dedicated']['heading1']) ? ucfirst($pageData['aboutus']['dedicated']['heading1']) : 'We are dedicated to making your poll contest a success.' !!} </h2>
      <p>{!! isset($pageData['aboutus']['dedicated']['description']) ? ucfirst($pageData['aboutus']['dedicated']['description']) : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. ' !!}  </p>
      <ul class="lstyle">
        <li>Pagaents</li>
        <li>Awards</li>
        <li>Shows</li>
        <li>Election</li>
        <li>Contests</li>
      </ul>
      </div>
    </div>
    </div>
  </div>
  
  <div id="why-choose" class="services">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="titleh2 tc">{!! isset($pageData['aboutus']['our services2']['heading1']) ? ucfirst($pageData['aboutus']['our services2']['heading1']) : 'Our Services' !!} </h2>
      <p>{!! isset($pageData['aboutus']['our services2']['description ']) ? ucfirst($pageData['aboutus']['our services2']['description  ']) : 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.' !!}   </p>
      <div class="service-sec row">
        @if(isset($services['bottom']) && !empty($services['bottom']))
          @foreach($services['bottom'] as $service)
          <div class="col-3 serv">
          <div class="serv-body">
            <img class="o-img" src="img/abt7.png">
            <img class="w-img" src="img/abt7w.png">
            <h3 class="titleh3 tc">{!! $service->name !!}</h3>
            <p>{!! $service->text !!}</p>
          </div>
          </div>
          @endforeach
        @endif
        
      
        
      </div>
      </div>
    </div>
    </div>
  </div>
  
  
  

@endsection