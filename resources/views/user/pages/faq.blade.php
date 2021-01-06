@extends('user.layouts.main')

@section('content')
 
<div id="faq-page" class="banner breadcrumb" style="background-image:url({!! isset($banners['img']) ? $banners['img'] : 'img/faqimg.jpg' !!})" >
    <div class="slider-content">
    <h4>{{ isset($banners['heading1']) ? $banners['heading1'] : '' }}</h4>
    <h2>{{ isset($banners['heading1']) ? $banners['heading2'] : '' }}</h2>
    <div class="lmore breadcrumb">
      <p>Home | <span>Frequently Asked Question</span></p>
    </div>
    </div>
  </div>
  
  <div class="faqs">
    <div class="container">
    <div id="accordion">
      @foreach($faqs as $key => $faq)
        <div class="card">
          <div class="card-header">
            <a class="card-link {{ ($key > 0) ? 'collapsed' : '' }}" data-toggle="collapse" href="#collapse{{$key}}">
              {!!  $faq->question !!}
            </a>
          </div>
          <div id="collapse{{$key}}" class="collapse {{ ($key == 0) ? 'show' : '' }}" data-parent="#accordion">
            <div class="card-body">
             {!!  $faq->answer !!}
            </div>
          </div>
        </div>
      @endforeach
      
      </div>
    </div>
  </div>

  
@endsection