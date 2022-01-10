<!-- Header -->
<div id="kt_header" class="header flex-column header-fixed">
    <!-- Top -->
    <div class="header-top">
        <div class="container-fluid mx-lg-5">
            <div class="d-none d-lg-flex align-items-center mr-3">
                <!-- Brand -->
                <a href="index.html" class="mr-20">
                    <img alt="Logo" src="{{ asset('images') }}/white-logo.png" class="max-h-35px" />
                </a>
                <!-- /. Brand -->

                <!-- Header Navs(for desktop mode) -->
                <ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
                    <!-- Master Admin Menu -->
                    @auth('masterAdmin')
                    <li class="nav-item">
                        <a href="{{ route('masteradmin.dashboard') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">Dashboard</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ route('groups.index') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'groups' ? 'active' : '' }}">Groups</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ route('wifi-routers.index') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'wifi-routers' ? 'active' : '' }}">Wifi Routers</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ route('admin-messages.index') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'admin-messages' ? 'active' : '' }}">Admin Messages</a>
                    </li>

                    <li class="nav-item">

                        <div class="dropdown">

                            <a href="#" class="nav-link py-4 px-6">
                             Forms
                            </a>

                            <div class="dropdown-content">
                                    <a href="{{ route('partner') }}" class="nav-link py-4 px-6">
                                        Partner
                                    </a>

                                    <a href="{{ route('contactdata') }}" class="nav-link py-4 px-6">
                                         Contact Data
                                    </a>
                            </div>
                        </div>



                        {{--<ul>--}}
                            {{--<li><a href=""></a>asdfasd </li>--}}
                        {{--</ul>--}}

                     </li>

                    @endauth
                    <!-- End Master Admin Menu -->

                    <!-- Group Admin Menu -->
                    @auth('groupAdmin')
                    <li class="nav-item">
                        <a href="{{ route('groupadmin.dashboard') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('operators.index') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'operators' ? 'active' : '' }}">Operators</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="{{ url('/group/users') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'users' ? 'active' : '' }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('discounts.index') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'discounts' ? 'active' : '' }}">Discounts</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="#" class="nav-link py-4 px-6">Campaigns</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="#" class="nav-link py-4 px-6">Bots</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="#" class="nav-link py-4 px-6">Settings</a>
                    </li>
                    @endauth
                    <!-- End Group Admin Menu -->

                    @auth('operator')
                    <li class="nav-item">
                        <a href="{{ route('operator.main') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'main' ? 'active' : '' }}">Main</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logs.index') }}" class="nav-link py-4 px-6 {{ request()->segment(2) == 'logs' ? 'active' : '' }}">Log</a>
                    </li>
                    @endauth
                </ul>
                <!-- End Header Navs -->
            </div>
            <div class="topbar bg-primary">
                <!-- Notifications -->
                <div class="dropdown">
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                        <div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-white">
                            <span class="svg-icon svg-icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" class="bi bi-bell-fill" viewBox="-2 -2 20 20">  
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                                </svg>
                            </span>
                            <span class="pulse-ring"></span>
                        </div>
                    </div>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                        <!-- @TODO implement -->
                    </div>
                </div>
                <!--End Notifications-->
                <!-- Messages -->
                <div class="topbar-item mr-1">
                    <div class="btn btn-icon btn-hover-transparent-white btn-clean btn-lg" data-toggle="modal" data-target="#kt_chat_modal">
                        <span class="svg-icon svg-icon-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L5,18 C3.34314575,18 2,16.6568542 2,15 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 Z M6.16794971,10.5547002 C7.67758127,12.8191475 9.64566871,14 12,14 C14.3543313,14 16.3224187,12.8191475 17.8320503,10.5547002 C18.1384028,10.0951715 18.0142289,9.47430216 17.5547002,9.16794971 C17.0951715,8.86159725 16.4743022,8.98577112 16.1679497,9.4452998 C15.0109146,11.1808525 13.6456687,12 12,12 C10.3543313,12 8.9890854,11.1808525 7.83205029,9.4452998 C7.52569784,8.98577112 6.90482849,8.86159725 6.4452998,9.16794971 C5.98577112,9.47430216 5.86159725,10.0951715 6.16794971,10.5547002 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>
                <!-- End messages -->
                <!-- Top profile -->
                @auth('masterAdmin')
                    @php
                        $loggedInLabel = 'Admin';
                        $displayName = auth('masterAdmin')->user()->name;
                        $initialAvatarText = auth('masterAdmin')->user()->initial_avatar_text;
                        $picture = '';
                    @endphp
                @endauth

                @auth('groupAdmin')
                    @php
                        $loggedInLabel = 'Manager';
                        $displayName = auth('groupAdmin')->user()->gp_groupname;
                        $initialAvatarText = auth('groupAdmin')->user()->initial_avatar_text;
                        $picture = '';
                    @endphp
                @endauth

                @auth('operator')
                    @php
                        $loggedInLabel = 'Operator';
                        $displayName = auth('operator')->user()->opr_name;
                        $initialAvatarText = auth('operator')->user()->initial_avatar_text;
                        $picture = '';
                    @endphp
                @endauth

                @auth('user')
                    @php
                        $loggedInLabel = 'Customer';
                        $displayName = auth('user')->user()->usr_fullname;
                        $initialAvatarText = auth('user')->user()->initial_avatar_text;
                        $picture = '';
                    @endphp
                @endauth
                <div class="topbar-item">
                    <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                        <div class="d-flex flex-column text-right pr-3">
                            <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">{{ $displayName }}</span>
                            <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">
                                {{ $loggedInLabel }}
                            </span>
                        </div>
                        <span class="symbol symbol-35">
                            <span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">
                                @if ($picture)
                                    <img src="" width="100%" height="100%" />
                                @elseif ($initialAvatarText)
                                    {{ $initialAvatarText }}
                                @else
                                <span class="svg-icon svg-icon-white svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo7\dist/../src/media/svg/icons\General\User.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" />
                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                                @endif
                            </span>
                        </span>
                    </div>
                </div>
                <!-- End profile -->
            </div>
        </div>
    </div>
    <!-- End Top -->
    <!-- Bottom -->
    <div class="header-bottom d-none">
        <div class="container">
            <div class="header-navs header-navs-left">
                <div class="header-menu header-menu-mobile header-menu-layout-default">
                    <!--begin::Nav-->
                    <ul class="menu-nav">
                        <li class="menu-item menu-item-active" aria-haspopup="true">
                            <a href="index.html" class="menu-link">
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item" aria-haspopup="true">
                            <a href="index.html" class="menu-link">
                                <span class="menu-text">Groups</span>
                            </a>
                        </li>
                        <li class="menu-item" aria-haspopup="true">
                            <a href="index.html" class="menu-link">
                                <span class="menu-text">Wifi Routers</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Nav-->
                </div>
            </div>
        </div>
    </div>
    <!-- End Bottom -->

    <!-- Mobile Toggle Menu -->
    <div class="header-navs header-navs-left mobile-toggle-menu d-lg-none" id="kt_header_navs">
        <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
            <ul class="menu-nav">
                <li class="menu-item menu-item-active" aria-haspopup="true">
                    <a href="index.html" class="menu-link">
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item" aria-haspopup="true">
                    <a href="index.html" class="menu-link">
                        <span class="menu-text">Groups</span>
                    </a>
                </li>
                <li class="menu-item" aria-haspopup="true">
                    <a href="index.html" class="menu-link">
                        <span class="menu-text">Wifi Routers</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Mobile Toggle Menu -->
</div>
<!-- End Header -->



<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
