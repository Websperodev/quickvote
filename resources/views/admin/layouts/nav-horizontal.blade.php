
<div class="topbar-menu">
    <div class="container">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fe-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
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
                        <li>
                            <a href="{{ route('team.index') }}">Our Team</a>
                        </li>
                        <!-- <li>
                            <a href="{{ route('admin.page',['name' => 'contact']) }}">Contact</a>
                        </li> -->

                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)">
                        <i class="fa fa-sliders" aria-hidden="true"></i>Sliders &nbsp;<div class="arrow-down"></div></a>
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
                        <i class="fa fa-picture-o" aria-hidden="true"></i>Banners &nbsp;<div class="arrow-down"></div></a>
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
                        <li>
                            <a href="{{ route('admin.banners',['name' => 'services']) }}">Services</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.banners',['name' => 'our-team']) }}">Our Team</a>
                        </li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>Countries &nbsp;<div class="arrow-down"></div></a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.countries.index') }}">Countries</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.states.index') }}">States</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.cities.index') }}">Cities</a>
                        </li>

                </li>
            </ul>
            </li>
            <li>
                <a href="{{ route('admin.vendors') }}">
                    <i class="fa fa-users" aria-hidden="true"></i>Vendors
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users') }}">
                    <i class="fa fa-users" aria-hidden="true"></i>Users
                </a>
            </li>
            <li>
                <a href="{{ route('admin.events') }}">
                    <i class="fa fa-calendar" aria-hidden="true"></i> Events
                </a>
            </li>

            <li class="has-submenu">
                <a href="javascript:void(0)">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>Voting &nbsp;<div class="arrow-down"></div></a>
                <ul class="submenu">
                    <li>

                        <a href="{{ route('admin.voting.index') }}">
                            <i class="fa fa-users" aria-hidden="true"></i>Voting contests
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories') }}">
                            <i class="fa fa-tasks" aria-hidden="true"></i> Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contestant.index') }}">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Contestants
                        </a>
                    </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="javascript:void(0)">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>Payments Management &nbsp;<div class="arrow-down"></div></a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.votes.payments') }}">Votes Payments</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tickets.payments') }}">Event Tickets Payments</a>
                    </li>


            </li>
            </ul>
            </li>


            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>