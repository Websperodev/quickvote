
<div class="topbar-menu">
    <div class="container">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <!-- <li>
                    <a href="#">
                        <i class="fe-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li> -->
                <li class="has-submenu">
                    <a href="javascript:void(0)">
                        <i class="fa fa-file" aria-hidden="true"></i>Pages &nbsp;<div class="arrow-down"></div></a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.page',['name' => 'home']) }}">Home Page</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.page',['name' => 'about']) }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.page',['name' => 'testimonials']) }}">Testimonials</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.page',['name' => 'pricing']) }}">Pricing</a>
                        </li>
                        <li>
                            <a href="{{ route('faqs.index') }}">Faq</a>
                        </li>
                        <!-- <li>
                            <a href="{{ route('admin.page',['name' => 'contact']) }}">Contact</a>
                        </li> -->
                        
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)">
                        <i class="fa fa-file" aria-hidden="true"></i>Sliders &nbsp;<div class="arrow-down"></div></a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.slider',['name' => 'home']) }}">Home Page</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.slider',['name' => 'trusted_brands']) }}">Trusted Brands</a>
                        </li>
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="javascript:void(0)">
                        <i class="fa fa-file" aria-hidden="true"></i>Banners &nbsp;<div class="arrow-down"></div></a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.banners',['name' => 'aboutus']) }}">About Banners</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.banners',['name' => 'contact']) }}">Contact</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.banners',['name' => 'pricing']) }}">Pricing</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.banners',['name' => 'faq']) }}">Faq</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="{{ route('admin.users') }}">Users</a>
                </li>
                <li>
                    <a href="{{ route('admin.categories') }}">Categories</a>
                </li>
                <li>
                    <a href="{{ route('admin.events') }}">Events</a>
                </li>
              
               

            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>