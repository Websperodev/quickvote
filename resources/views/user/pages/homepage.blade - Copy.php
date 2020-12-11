@extends('layouts.main')


@section('content')
<br><br><br>

<!--hero section start-->

<section>


  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-lg-5 col-lg-6 order-lg-2 mb-8 mb-lg-0">
        <!-- Image -->
        <img src="{{asset('test/img/01.png')}}" class="img-fluid" alt="{{asset('test/img/02.png')}}">
      </div>
      <div class="col-12 col-lg-7 col-xl-6 order-lg-1">
        <!-- Heading -->
        <h5 class="badge badge-primary-soft font-w-6">Ever Wished For</h5>
        <h1 class="display-4">
              Transparent Digital<span class="text-primary">Polls</span>?              
            </h1>
        <!-- Text -->
        <p class="lead text-muted">Create a poll Contest in seconds. Your voters can vote from any location on any device.
        </p>
        <!-- Buttons --> <a href="#about" class="btn btn-primary shadow mr-1 home1">
                Learn More
              </a>
        <a href="/register" class="btn btn-outline-primary home2">
                Get Started
              </a>

              <div class="container trlogo"><br><h6 style="letter-spacing: 2px;font-size: 10px;opacity: 0.6;padding-left: 14px;">TRUSTED BY GREAT BRANDS IN NIGERIA</h6>
	              	<section class="customer-logos slider">
	      				<div class="slide"><img src="{{asset('test/img/10.png')}}"></div>
	      				<div class="slide"><img src="{{asset('test/img/11.png')}}"></div>
	      				<div class="slide"><img src="{{asset('test/img/12.png')}}"></div>
	      				<div class="slide"><img src="{{asset('test/img/13.png')}}"></div>
	      				<div class="slide"><img src="{{asset('test/img/14.png')}}"></div>
	      				<div class="slide"><img src="{{asset('test/img/15.png')}}"></div>
	      				<div class="slide"><img src="{{asset('test/img/16.jpg')}}"></div>
	      
	   				</section>
              </div>

              
    
        </div>
      </div>
    </div>
    <!-- / .row -->
  </div>
  <!-- / .container -->
</section>

<!--hero section end--> 
<br><br><br>


 

<!--body content start-->

<div class="page-content">

<!--feature start-->

<section class="text-center p-0">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-4 col-lg-4 mb-8 mb-lg-0">
        <div class="px-4 py-7 rounded hover-translate" data-bg-color="rgba(19, 96, 239, 0.01)">
          <div>
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#f94f15" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
              <rect x="3" y="3" width="7" height="7"></rect>
              <rect x="14" y="3" width="7" height="7"></rect>
              <rect x="14" y="14" width="7" height="7"></rect>
              <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
          </div>
          <h5 class="mt-4 mb-3">Transparency</h5>
          <p class="mb-0">You get real time statistics and analytics of all poll Contests.</p>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-sm-6">
        <div class="px-4 py-7 rounded hover-translate">
          <div>
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square">
              <polyline points="9 11 12 14 22 4"></polyline>
              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
          </div>
          <h5 class="mt-4 mb-3">Easy To Use</h5>
          <p class="mb-0">Creating a poll Contest is so easy, you will only take a few minutes</p>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-sm-6 mt-6 mt-sm-0">
        <div class="px-4 py-7 rounded hover-translate">
          <div>
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#f94f15" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-wifi">
              <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
              <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
              <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
              <line x1="12" y1="20" x2="12" y2="20"></line>
            </svg>
          </div>
          <h5 class="mt-4 mb-3">Accessibility</h5>
          <p class="mb-0">All poll Contests can be easily accessed on any device, anywhere</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!--feature end-->


<form class="row domain-search bg-pblue mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="form-title">Find Contest<strong></strong></h2>
                <p>Which Contest are you looking for?</p>
            </div>
            <div class="col-md-9">
                <div class="input-group"> <input type="search" class="form-control"> <span class="input-group-addon"><input type="submit" value="Search" class="btn btn-primary ser"></span> </div>
                <!-- <p>.com <strong>$8.95</strong>.net <strong>$7.95</strong>.org <strong>$9.95</strong>.club <strong>$0.99</strong></p> -->
            </div>
        </div>
    </div>
</form>


<div class="container-fluid contest"><br><h3 style="letter-spacing: 1px;foopacity: 0.6;padding-left: 14px;text-align: center">Featured Contests</h3>
	<p style="color:black !important;" class="text-center">We support all types of poll events, here are some recent events created on our platform.</p>
	              	<section class="customer-logos slider">
	      				<div class="slide">
	      					
							<div class="card" >
							  <img src="{{asset('test/img/event.jpg')}}" class="card-img-top" alt="{{asset('test/img/event.jpg')}}" style="opacity: 1;">
							  <div class="card-body">
							    <h5 class="card-title">BUSINESS SUPPORT SCHEME</h5>
							    <p class="card-text"><i class="fa fa-calendar" aria-hidden="true"></i>  Wed May 27 2020 - Sat June 20 2020</p>
							    <a href="#" class="btn btn-primary">VIEW CONTEST <i class="fa fa-arrow-right" aria-hidden="true"></i>  </a>
							  </div>
							</div>

	      				</div>


	      				<div class="slide">
	      					
							<div class="card">
							 <img src="{{asset('test/img/event2.jpg')}}" class="card-img-top" alt="{{asset('test/img/event2.jpg')}}" style="opacity: 1;">
							  <div class="card-body">
							    <h5 class="card-title">MISS ENTREPRENEURSHIP 2020</h5>
							    <p class="card-text"><i class="fa fa-calendar" aria-hidden="true"></i>  Wed June 10 2020 - Tue June 30 2020</p>
							    <a href="#" class="btn btn-primary">VIEW CONTEST <i class="fa fa-arrow-right" aria-hidden="true"></i>  </a>
							  </div>
							</div>

	      				</div>

	      				<div class="slide">
	      					
							<div class="card">
							  <img src="{{asset('test/img/event3.jpg')}}" class="card-img-top" alt="{{asset('test/img/event3.jpg')}}" style="opacity: 1;">
							  <div class="card-body">
							    <h5 class="card-title">Face of Cultural Photo Contest</h5>
							    <p class="card-text"><i class="fa fa-calendar" aria-hidden="true"></i>  Wed June 10 2020 - Wed July 01 2020</p>
							    <a href="#" class="btn btn-primary">VIEW CONTEST <i class="fa fa-arrow-right" aria-hidden="true"></i>  </a>
							  </div>
							</div>

	      				</div>

	      				<div class="slide">
	      					
							<div class="card" >
							  <img src="{{asset('test/img/event4.jpg')}}" class="card-img-top" alt="{{asset('test/img/event4.jpg')}}" style="opacity: 1;">
							  <div class="card-body">
							    <h5 class="card-title">FACIAL CHALLENGE ONLINE CONTEST SEASON 2</h5>
							    <p class="card-text"><i class="fa fa-calendar" aria-hidden="true"></i>  Tue June 09 2020 - Tue June 30 2020</p>
							    <a href="#" class="btn btn-primary">VIEW CONTEST <i class="fa fa-arrow-right" aria-hidden="true"></i>  </a>
							  </div>
							</div>

	      				</div>


	      				<div class="slide">
	      					
							<div class="card" >
							  <img src="{{asset('test/img/event5.jpg')}}" class="card-img-top" alt="{{asset('test/img/event5.jpg')}}" style="opacity: 1;">
							  <div class="card-body">
							    <h5 class="card-title">TALENTS AWARD AND GALA NIGHT 2020</h5>
							    <p class="card-text"><i class="fa fa-calendar" aria-hidden="true"></i>  Wed May 27 2020 - Sat June 20 2020</p>
							    <a href="#" class="btn btn-primary">VIEW CONTEST <i class="fa fa-arrow-right" aria-hidden="true"></i>  </a>
							  </div>
							</div>

	      				</div>


	      				<div class="slide">
	      					
							<div class="card" >
							  <img src="{{asset('test/img/event6.jpg')}}" class="card-img-top" alt="{{asset('test/img/event6.jpg')}}" style="opacity: 1;">
							  <div class="card-body">
							    <h5 class="card-title">RYTHM</h5>
							    <p class="card-text"><i class="fa fa-calendar" aria-hidden="true"></i>  Wed May 27 2020 - Sat June 20 2020</p>
							    <a href="#" class="btn btn-primary">VIEW CONTEST <i class="fa fa-arrow-right" aria-hidden="true"></i>  </a>
							  </div>
							</div>

	      				</div>
	      			
	   				</section>

					<div style="text-align: center!important;">
						<a href="#"  class="btn btn-lg btn-outline-primary home1">VIEW ALL CONTESTS <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
						
					</div>
	   				
              </div>





<br><br><br><br>


<!--about start-->

<section id="about">
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <div class="col-12 col-lg-6 mb-6 mb-lg-0">
        <img src="{{asset('test/img/02.png')}}" alt="Image" class="img-fluid">
      </div>
      <div class="col-12 col-lg-6 col-xl-5">
        <div> <!-- <span class="badge badge-primary-soft p-2">
                  <i class="la la-exclamation ic-3x rotation"></i>
              </span> -->
          <h2 class="mt-3">We are dedicated to making your poll Contest a success</h2>
          <p class="lead">We adopt latest technologies to make your poll Contest a success from start to finish, ypu can use our platform for any type of poll Contests</p>
        </div>
        <div class="d-flex flex-wrap justify-content-start">
          <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">
            <div class="d-flex align-items-center">
              <div class="badge-primary-soft rounded p-1">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
              </div>
              <p class="mb-0 ml-3">Pagaents</p>
            </div>
          </div>
          <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">
            <div class="d-flex align-items-center">
              <div class="badge-primary-soft rounded p-1">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
              </div>
              <p class="mb-0 ml-3">Awards</p>
            </div>
          </div>
          <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">
            <div class="d-flex align-items-center">
              <div class="badge-primary-soft rounded p-1">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
              </div>
              <p class="mb-0 ml-3">Shows</p>
            </div>
          </div>
          <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">
            <div class="d-flex align-items-center">
              <div class="badge-primary-soft rounded p-1">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
              </div>
              <p class="mb-0 ml-3">Elections</p>
            </div>
          </div>
          <div class="mb-3 mr-4 ml-lg-0 mr-lg-4">
            <div class="d-flex align-items-center">
              <div class="badge-primary-soft rounded p-1">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
              </div>
              <p class="mb-0 ml-3">Contests</p>
            </div>
          </div>    
        </div>
        <a href="#" class="btn btn-outline-primary mt-3 createContest home2">
          Create Contest
        </a>
      </div>
    </div>
  </div>
</section>

<!--about end-->

<!--feature start-->
<section>
    <div class="container-fluid mt-5 mb-5 feature1" >
      <div class="row align-items-center justify-content-between">
        <div class="col-12 col-lg-5 col-xl-5 mb-8 mb-lg-0 order-lg-1">
          <img src="{{asset('test/img/06.png')}}" alt="Image" class="img-fluid">
        </div>
        <div class="col-12 col-lg-7 col-xl-6">
          <div class="mb-8">
            <h2 class="font-w-9 mb-4">Deep Insight on Why to Choose Quickvote</h2>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="d-flex align-items-start">
                <div class="mr-3 p-3 border rounded border-light shadow-primary">
                  <img class="img-fluid" src="{{asset('test/img/svg/2.svg')}}" alt="">
                </div>
                <div>
                  <h5 class="mb-3 text-primary">User Anonimity</h5>
                  <p class="mb-0">Voters are anonymous. the votes count without anyone knowing who voted exactly, just the vote and the person voted for</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-6 mt-md-0">
              <div class="d-flex align-items-start">
                <div class="mr-3 p-3 border rounded border-light shadow-primary">
                  <img class="img-fluid" src="{{asset('test/img/svg/5.svg')}}" alt="">
                </div>
                <div>
                  <h5 class="mb-3 text-primary">Results Safety</h5>
                  <p class="mb-0">Your results are safe and always available real time in graphs and charts. our pages are  secured with 256bit SSL encryption,no one can tamper with your results</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-6">
              <div class="d-flex align-items-start">
                <div class="mr-3 p-3 border rounded border-light shadow-primary">
                  <img class="img-fluid" src="{{asset('test/img/svg/6.svg')}}" alt="">
                </div>
                <div>
                  <h5 class="mb-3 text-primary">Easy to Customize</h5>
                  <p class="mb-0">You can easily setup your poll Contests with your category, add your own contestants or partcicipants and also the amount for paid votes.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-6">
              <div class="d-flex align-items-start">
                <div class="mr-3 p-3 border rounded border-light shadow-primary">
                  <img class="img-fluid" src="{{asset('test/img/svg/4.svg')}}" alt="">
                </div>
                <div>
                  <h5 class="mb-3 text-primary">Mobile Ready</h5>
                  <p class="mb-0">Our system is optimized for desktop and mobile devices. Voters can vote from a PC web browser or browsers on mobile devices.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<!--feature end-->

<div class="container my-5">


  <!--Section: Content-->
  <section class="text-center dark-grey-text">

    <h2 class="font-weight-bold pb-2 ">Simple, Fair and affordable prices for all. </h2>
  
    <!-- Section description -->
    <p class="text-muted w-responsive mx-auto mb-5">
			Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.	</p>
         	


    <!-- Grid row -->
    <div class="row">


<!-- Grid column -->
      <div class="col-lg-4 col-md-6 mb-4">

        <!-- Pricing card -->
        <div class="price">
		
    
        	<!-- Section heading -->
   <br class="price1"> <br class="price1">
    <img src="{{asset('test/img/price.png')}}" class="img-fluid" alt="{{asset('test/img/02.png')}}" width="600px " >
    <!-- Section description -->
  

        </div>
        <!-- Pricing card -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-lg-4 col-md-12 mb-4">

        <!-- Pricing card -->
        <div class="card pricing-card">

          <!-- Price -->
          <div class="price header white-text black rounded-top mt-0">
            <h2 class="number mt-3">FREMIUM</h2>
            <div class="version">
              <h5 class="mb-0"></h5>
            </div>
          </div>

          <!-- Features -->
          <div class="card-body striped mb-1">

            <ul>
              <li>
                <p class="mt-2"><i class="fas fa-check green-text pr-2"></i>Instant voting</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>Support & Monitoring</p>
              </li>
              <li>
                <p><i class="fas fa-times red-text pr-2"></i>Voters Pays to Vote</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>Results Export</p>
              </li>
              
            </ul>


			<span class="price display-4 text-primary font-w-6">&#8358;50,000</span>
                
                <!-- Text -->
                <p class="text-center text-muted">One-time Contest fee</p>
                <!-- Button --> <a href="#" class="btn btn-block btn-primary mt-0 createContest home2">
                Create Freemium Contest
              </a>


					
				










          </div>
          <!-- Features -->

        </div>
        <!-- Pricing card -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-lg-4 col-md-6 mb-4">

        <!-- Pricing card -->
        <div class="card pricing-card">

          <!-- Price -->
          <div class="price header white-text orange rounded-top ">
            <h2 class="number mt-3">PAID</h2>
            <div class="version">
              <h5 class="mb-0"></h5>
            </div>
          </div>

          <!-- Features -->
          <div class="card-body striped mb-1">

            <ul>
              <li>
                <p class="mt-2"><i class="fas fa-check green-text pr-2"></i>Instant voting</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>Support & Monitoring</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>Voters Pays to Vote</p>
              </li>
              <li>
                <p><i class="fas fa-check green-text pr-2"></i>Results Export</p>
              </li>
              
            </ul>

            <span class="price display-4 text-primary font-w-6">20</span>
                  <span class="h3 mb-0 mt-2">%</span>
               
                <!-- Text -->
                <p class="text-center text-muted">Per vote</p>
                <!-- Button --> <a href="#" class="btn btn-block btn-primary mt-0 createContest home3">
                Create Paid Contest
              </a>


          </div>
          <!-- Features -->

        </div>
        <!-- Pricing card -->

      </div>
      <!-- Grid column -->

      
    </div>
    <!-- Grid row -->

  </section>
  <!--Section: Content-->

























<hr>

<div class="container my-5 px-5 pt-5 pb-3 ">
  
  <!--Section: Content-->
  <section class="text-center dark-grey-text">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 mb-4">

      	<div class="wrapper-carousel-fix">
        
          <!-- Carousel Wrapper -->
          <div id="carousel-example-1" class="carousel no-flex testimonial-carousel slide" data-ride="carousel"
            data-interval="false">
            <h3 class="mt-4 mb-4 ">Chekout Our Client Feedbacks</h3>
            
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
              <!--First slide-->
              <div class="carousel-item active">
                <p class="lead font-italic">"All of our voters loved how professional the site is. As an organizer, I found it very easy to setup. Great application."</p>
                <div class="view card-img-64 mx-auto mt-5 mb-4">
                  <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(2).jpg" class="rounded-circle img-fluid" alt="smaple image">
                </div>
                <p class="text-muted">- Anna Morian</p>
              </div>
              <!--First slide-->
              <!--Second slide-->
              <div class="carousel-item">
                <p class="lead font-italic">"I appreciate how the voting process is user friendly and easy. this application was awesome as a first time user."</p>
                <div class="view card-img-64 mx-auto mt-5 mb-4">
                  <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" class="rounded-circle img-fluid" alt="smaple image">
                </div>
                <p class="text-muted">-Joseph Adewale, <i>Developer Awards</i></p>
              </div>
              <!--Second slide-->
              <!--Third slide-->
              <div class="carousel-item">
                <p class="lead font-italic">"our experience with Quickvote was smooth and efficient. We look forward to using them again for our next polls."</p>
                <div class="view card-img-64 mx-auto mt-5 mb-4">
                  <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(10).jpg" class="rounded-circle img-fluid" alt="smaple image">
                </div>
                <p class="text-muted">- Kate Allise</p>
              </div>
              <!--Third slide-->
            </div>
            <!--Slides-->
            <!--Controls-->
            <a class="carousel-control-prev left carousel-control" href="#carousel-example-1" role="button"
              data-slide="prev">
              <span class="icon-prev" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next right carousel-control" href="#carousel-example-1" role="button"
              data-slide="next">
              <span class="icon-next" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
            <!--Controls-->
          </div>
          <!-- Carousel Wrapper -->
          
        </div>
        
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->
    
  </section>
  <!--Section: Content-->


</div>      






   
   <script type="text/javascript">
    $(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2300,
        arrows: true,
        dots: false,
        pauseOnHover: true,
        responsive: [{
            breakpoint: 968,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 1
            }
        }]
    });
});




    $('.carousel').carousel({
	interval: 3000
})
  </script>
@endsection