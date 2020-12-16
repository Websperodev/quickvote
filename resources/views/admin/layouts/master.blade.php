<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('meta_page_title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="#">
        @include('admin.layouts.head')

    </head>

    <body>

    <header id="topnav">
        @include('admin.layouts.topbar')
            <div class="desk">
        @include('admin.layouts.nav-horizontal') 
        </div>
        </header>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="wrapper full-width">
            <div id="full_page_loader" class="loader_wrapper d-none ">
                <div class="spinner-border avatar-lg text-primary m-2" role="status"></div>
            </div>
            <div class="container">
               <!-- Navigation Bar-->
                <div class="left-sidebar-back" >
                   @include('admin.layouts.nav-horizontal') 
                </div>
                <!-- End Navigation Bar-->
                <div class="right-cont-section">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    @yield('page_directory')
                                </div>
                                <h4 class="page-title">@yield('page_title')</h4>
                            </div>
                        </div>
                    </div>    
                    @yield('content')
                </div>
                <div class="clearfix"></div>
            </div> <!-- end container -->
            <div class="clearfix"></div>
            @include('admin.layouts.footer')    
            
            
        </div>
        <!-- end wrapper -->
        @include('admin.layouts.footer-script')   
        @include('admin.layouts.flash-message') 

        <script>
           jQuery(".has-submenu").click(function(){ 
            jQuery(".submenu").removeClass( "show-menu" );          
            jQuery(this).find(".submenu").addClass("show-menu");
            //jQuery(".navigation-menu li").addClass("show-menu");
            });
        </script>
   
    </body>

</html>