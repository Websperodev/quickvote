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
