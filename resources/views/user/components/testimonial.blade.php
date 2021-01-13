<div id="tests">
    <div class="container text-center">
    <h2 class="titleh2 tc">{{ isset($pageData['testimonial']['heading1']) ? $pageData['testimonial']['heading1'] : 'What Our Client Say' }}</h2>
    <p> {!! isset($pageData['testimonial']['description']) ? $pageData['testimonial']['description'] : 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.' !!} </p>
    <div class="owl-carousel owl-theme">

      @foreach($testimonials as $k => $testimonial)
      <div class="item {{ ($k==0) ? 'first' : ''}}">
        <div class="tcard border-0 py-3 px-4">
          <div class="row justify-content-center"> <img src="{!! url($testimonial->img) !!}" class="img-fluid profile-pic mb-4 mt-3"> </div>
          <h6 class="mb-3 mt-2">{!! $testimonial->name !!}</h6>
          <p class="content mb-3 mx-2">{!! $testimonial->description !!}</p>
        </div>
      </div>
      @endforeach
      <!-- <div class="item">
        <div class="tcard border-0 py-3 px-4">
          <div class="row justify-content-center"> <img src="img/t2.png" class="img-fluid profile-pic mb-4 mt-3"> </div>
          <h6 class="mb-3 mt-2">Ximena Vegara</h6>
          <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
        </div>
      </div>
      <div class="item">
        <div class="tcard border-0 py-3 px-4">
          <div class="row justify-content-center"> <img src="img/t3.png" class="img-fluid profile-pic mb-4 mt-3"> </div>
          <h6 class="mb-3 mt-2">John Paul</h6>
          <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
        </div>
      </div>
      <div class="item">
        <div class="tcard border-0 py-3 px-4">
          <div class="row justify-content-center"> <img src="img/t2.png" class="img-fluid profile-pic mb-4 mt-3"> </div>
          <h6 class="mb-3 mt-2">William Doe</h6>
          <p class="content mb-3 mx-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
        </div>
      </div> -->

    </div>
    </div>
  </div>