
<div class="topbar-menu">
    <div class="container">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <li>
                    <a href="{{ route('vendor.dashboard') }}">
                        <i class="fe-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="has-submenu">
                    <a href="javascript:void(0)">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>Voting &nbsp;<div class="arrow-down"></div></a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.events') }}">
                                <i class="fa fa-calendar" aria-hidden="true"></i> Events
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('event-categories.index') }}">
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

            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>