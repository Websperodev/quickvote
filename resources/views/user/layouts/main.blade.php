<!DOCTYPE html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quick Vote</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet" />
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
  <script src="{{asset('js/bootstrap.bundle.js')}}" ></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  
  <script>
  $(document).ready(function() {

  $('.owl-carousel').owlCarousel({
  mouseDrag:false,
  loop:true,
  margin:2,
  nav:true,
  responsive:{
  0:{
  items:1
  },
  600:{
  items:1
  },
  1000:{
  items:3
  }
  }
  });

  $('.owl-prev').click(function() {
  $active = $('.owl-item .item.show');
  $('.owl-item .item.show').removeClass('show');
  $('.owl-item .item').removeClass('next');
  $('.owl-item .item').removeClass('prev');
  $active.addClass('next');
  if($active.is('.first')) {
  $('.owl-item .last').addClass('show');
  $('.first').addClass('next');
  $('.owl-item .last').parent().prev().children('.item').addClass('prev');
  }
  else {
  $active.parent().prev().children('.item').addClass('show');
  if($active.parent().prev().children('.item').is('.first')) {
  $('.owl-item .last').addClass('prev');
  }
  else {
  $('.owl-item .show').parent().prev().children('.item').addClass('prev');
  }
  }
  });

  $('.owl-next').click(function() {
  $active = $('.owl-item .item.show');
  $('.owl-item .item.show').removeClass('show');
  $('.owl-item .item').removeClass('next');
  $('.owl-item .item').removeClass('prev');
  $active.addClass('prev');
  if($active.is('.last')) {
  $('.owl-item .first').addClass('show');
  $('.owl-item .first').parent().next().children('.item').addClass('prev');
  }
  else {
  $active.parent().next().children('.item').addClass('show');
  if($active.parent().next().children('.item').is('.last')) {
  $('.owl-item .first').addClass('next');
  }
  else {
  $('.owl-item .show').parent().next().children('.item').addClass('next');
  }
  }
  });

  });
  </script>
  
  <script>
  ///////////////// fixed menu on scroll for desktop
  if ($(window).width() > 992) {
    $(window).scroll(function(){  
     if ($(this).scrollTop() > 40) {
      $('#navbar_top').addClass("fixed-top");
      // add padding top to show content behind navbar
      $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
      }else{
      $('#navbar_top').removeClass("fixed-top");
       // remove padding top from body
      $('body').css('padding-top', '0');
      }   
    });
  } // end if
  </script>

 
  
  </head>
<body>

  @include('user.layouts.nav')
   <div class="page-start"> 
      @yield('content')
   </div>




    @include('user.layouts.footer')


  


</body>
</html>
