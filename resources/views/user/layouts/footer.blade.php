<div id="tests">
    <div class="container text-center">
    <h2 class="titleh2 tc">{!! isset($pageData['testimonial']['heading1']) ? ucfirst($pageData['testimonial']['heading1']) : 'What Our Client Say' !!}</h2>
    <p>{!! isset($pageData['testimonial']['description']) ? ucfirst($pageData['testimonial']['description']) : 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.' !!} </p>
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
      <h2 class="titleh2">{!! isset($pageData['news and update']['heading1']) ? ucfirst($pageData['news and update']['heading1']) : 'News and Updates' !!} </h2>
      <p>{!! isset($pageData['news and update']['description']) ? ucfirst($pageData['news and update']['description']) : 'Subscribe to our newsletter and receive the latest news from QuickVote.' !!}</p>
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
    <h2 class="titleh2 tc">{!! isset($pageData['trusted brands']['heading1']) ? ucfirst($pageData['trusted brands']['heading1']) : 'Trusted By Great Brands In Nigeria' !!} </h2>

    <div class="customer-logos">
      @if(isset($sliders['trusted brands']) && !empty($sliders['trusted brands']))
        @foreach($sliders['trusted brands'] as $k => $slider)
          <div class="slide"><img src="{{ url("$slider->img1") }}"></div>
        @endforeach
      @endif

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
<footer id="footer" class="footer pt-5">
    <div class="container"> 
    <div class="row">
      <div class="col col1">
      <h2 class="titleh2">Quick Vote</h2>
      <p>QuickVote is a web based voting platform that allows you to create and manage your own Contests. QuickVote is much more than a platform-it’s a revolution.</p>
      </div>
      <div class="col col2">
      <h2 class="titleh2">Navigation</h2>
      <ul class="footer-li">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Create Contest</a></li>
        <li><a href="#">View Contests</a></li>
        <li><a href="#">How It Works</a></li>
        <li><a href="#">Pricing</a></li>
      </ul>
      </div>
      <div class="col col3">
      <h2 class="titleh2">Useful Links</h2>
      <ul class="footer-li">
        <li><a href="#">Legal</a></li>
        <li><a href="#">Term Of Services</a></li>
        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
      </div>
      <div class="col col4">
      <h2 class="titleh2">Contact Us</h2>
      <ul class="footer-li adds">
        <li> <i class="fas fa-home mr-3"></i> <span>No 17 Musa Traore Street, Asokoro, Abuja</span></li>
        <li> <i class="fas fa-envelope mr-3"></i> <span>supports@quickvote.ng</span></li>
        <li> <i class="fas fa-phone mr-3"></i> <span>+234 805 368 2130</span></li>
        <li> <i class="fas fa-globe mr-3"></i> <span>www.quickvote.ng</span></li>
      </ul>
      </div>
    </div>
    </div>
    <div class="copyright"><p align="center">© 2020 Copyright QuickVote Nigeria Powered By Toast Technologies</p></div>
  </footer>
