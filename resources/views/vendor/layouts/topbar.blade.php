<!--Topbar Start -->
<div class="navbar-custom">
    <div class="cont">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="dropdown notification-list">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

            <li class="dropdown notification-list">
                <!-- {{ URL::asset('assets/images/cfl-logo.png') }} -->

                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="{{url('/')}}" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ URL::asset('assets/images/avatar-11.jpg') }}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                    {{ ucfirst(\Auth::user()->first_name) }} <i class="mdi mdi-chevron-down"></i> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>
    
                    <!-- item-->
                    <a href="{{ route('vendor.myaccount') }}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>
                    <a href="{{ route('vendor.changePassword') }}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Change Password</span>
                    </a>
    
                    <div class="dropdown-divider"></div>
    
                    <!-- item-->
                    <a href="{{ route('user.logout') }}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>
                    
                </div>
            </li>
        </ul>
    
        <!-- LOGO -->
        <div class="logo-box">
            <a href="#" class="logo text-center">
                <span class="logo-lg">
                    <img style="width: auto;height: 60px;" src="{{asset('img/qv-logo.png')}}" alt="logo-img" height="18">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-sm">
                    <!-- <span class="logo-sm-text-dark">U</span> -->
                    <img src="#" alt="" height="24">
                </span>
            </a>
        </div>
        <div class="sidenav-btnn">
		  <button class="hamburger">
			<span></span>
			<span></span>
			<span></span>
		  </button>
		  
		  <script>
			$("button.hamburger").click(function(){
			  $(this).toggleClass("is-open");
			  $('.dashbrd #sidebar').toggleClass('open')
			});
		  </script>
		</div>
    </div> <!-- end container-fluid-->
</div>
<!-- end Topbar-->

