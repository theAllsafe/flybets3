<style>
    [dir=ltr] .sidebar-submenu>.sidebar-menu-item .sidebar-menu-text:before {
        content: none;
    }
</style>
<div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left bg-white" data-perfect-scrollbar>
            <div class="sidebar-block p-0 m-0">
                <div class="d-flex align-items-center sidebar-p-a border-bottom bg-light">
                    <a href="#" class="flex d-flex align-items-center text-body text-underline-0">
                        <span class="avatar avatar-sm mr-2">
                            <span class="avatar-title rounded-circle bg-soft-secondary text-muted">
                                {{ auth()->user()->getAvatar() }}
                            </span>
                        </span>
                        <span class="flex d-flex flex-column">
                            <strong>{{ auth()->user()->first_name. ' ' . auth()->user()->last_name }}</strong>
                            <small class="text-muted text-uppercase">Owner</small>
                        </span>
                    </a>
                    <div class="dropdown ml-auto">
                        <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted">
                            <i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                            <a class="dropdown-item {{str_ends_with(request()->url(), 'user/'.auth()->id()) == true ? 'active' : ''}}"
                                href="{{ route('user.show', auth()->id() ) }}">My profile</a>
                            <a class="dropdown-item {{str_ends_with(request()->url(), 'user/'.auth()->id().'/edit') == true ? 'active' : ''}}"
                                href="{{ route('user.edit', auth()->id()) }}">Edit Account</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" rel="nofollow" data-method="delete" href="#logout"
                                onclick="document.getElementById('logout').submit()">Logout</a>
                            <form action="{{route('logout')}}" method="post" id="logout" style="display: none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar-block p-0">
                <ul class="sidebar-menu mt-0">
                    <li
                        class="sidebar-menu-item {{str_ends_with(request()->url(), 'dashboard') == true ? 'active open' : ''}}">
                        <a class="sidebar-menu-button" href="{{ route('dashboard') }}">
                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                @if(str_ends_with(request()->url(), 'dashboard') == true)
                                <img src="{{ asset('assets/12FlyIcons/dashboardactiveicon2x.png') }}" width="30"
                                    height="30" alt="">
                                @else
                                <img src="{{ asset('assets/12FlyIcons/dashboardinactiveicon2x.png') }}" width="20"
                                    height="20" alt="">
                                @endif
                            </span>
                            <span class="sidebar-menu-text">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <div class="sidebar-heading">MY RECORDS</div>
                <ul class="sidebar-menu mt-0">
                    @if(auth()->user()->is_pilot == 1)
                    <li
                        class="sidebar-menu-item {{str_contains(request()->url(), 'unmanned-aircraft') == true ? 'active open' : ''}}">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#unmanned_aircraft">
                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                @if(str_contains(request()->url(), 'unmanned-aircraft') == true)
                                <img width="30" height="30" alt=""
                                    src="{{ asset('assets/12FlyIcons/aircraftactiveicon2x.png') }}">
                                @else
                                <img src="{{ asset('assets/12FlyIcons/aircrafticon2x.png') }}" width="30" height="18"
                                    alt="">
                                @endif
                            </span>
                            <span class="sidebar-menu-text">Unmanned Aircraft</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="unmanned_aircraft" style="list-style-type: square">
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/unmanned-aircraft/create') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('unmanned-aircraft.create') }}">
                                    <span class="sidebar-menu-text">Add an Unmanned Aircraft</span>
                                </a>
                            </li>
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/unmanned-aircraft') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('unmanned-aircraft.index') }}">
                                    <span class="sidebar-menu-text">Manage Unmanned Aircraft</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li
                        class="sidebar-menu-item {{str_contains(request()->url(), 'uas-operator') == true ? 'active open' : ''}}">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#uas_operator">
                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                @if(str_contains(request()->url(), 'uas-operator') == true)
                                <img src="{{ asset('assets/12FlyIcons/uasoperatoractiveicon2x.png') }}" width="30"
                                    height="30" alt="">
                                @else
                                <img src="{{ asset('assets/12FlyIcons/uasoperatoricon2x.png') }}" width="20" height="20"
                                    alt="">
                                @endif
                            </span>
                            <span class="sidebar-menu-text">UAS Operator</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="uas_operator">
                            @if(auth()->user()->is_pilot)
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/uas-operator/'.auth()->id().'/edit') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('uas-operator.edit', auth()->id()) }}">
                                    <span class="sidebar-menu-text">Update Profile</span>
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->has_org && session()->get('active_operator_type')[0] == 'o')
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/uas-operator') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('uas-operator.index') }}">
                                    <span class="sidebar-menu-text">Manage UAS Pilot</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @if(auth()->user()->is_pilot == 1)
                    <li
                        class="sidebar-menu-item {{str_contains(request()->url(), 'flight-plan') == true ? 'active open' : ''}}">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#flight_plans">
                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                @if(str_contains(request()->url(), 'flight-plan') == true)
                                <img src="{{ asset('assets/12FlyIcons/flightplansactiveicon2x.png') }}" width="30"
                                    height="30" alt="">
                                @else
                                <img src="{{ asset('assets/12FlyIcons/flightplansicon2x.png') }}" width="20" height="20"
                                    alt="">
                                @endif
                            </span>
                            <span class="sidebar-menu-text">Flight Plans</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="flight_plans">
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/flight-plan/create') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('flight-plan.create') }}">
                                    <span class="sidebar-menu-text">Add a Flight Plans</span>
                                </a>
                            </li>
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/flight-plan') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('flight-plan.index') }}">
                                    <span class="sidebar-menu-text">Manage Flight Plans</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="sidebar-menu-item {{str_contains(request()->url(), 'organisation') == true ? 'active open' : ''}}">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#organisation">
                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                @if(str_contains(request()->url(), 'organisation') == true)
                                <img src="{{ asset('assets/12FlyIcons/orgactiveicon2x.png') }}" width="30" height="30"
                                    alt="">
                                @else
                                <img src="{{ asset('assets/12FlyIcons/orgicon2x.png') }}" width="20" height="20" alt="">
                                @endif
                            </span>
                            <span class="sidebar-menu-text">Organisation</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="organisation">
                            {{-- @if(!auth()->user()->has_org)--}}
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/organisation/create') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('organisation.create') }}">
                                    <span class="sidebar-menu-text">Add an Organisation</span>
                                </a>
                            </li>
                            {{-- @endif--}}
                            @if(auth()->user()->has_org && session()->get('active_operator_type')[0] == 'o')
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/organisation/edit') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('organisation.edit') }}">
                                    <span class="sidebar-menu-text">Update an Organisation</span>
                                </a>
                            </li>
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/organisation') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('organisation.index') }}">
                                    <span class="sidebar-menu-text">Manage User</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    <li
                        class="sidebar-menu-item {{str_contains(request()->url(), 'support') == true ? 'active open' : ''}}">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#support">
                            <span class="sidebar-menu-icon sidebar-menu-icon--left">
                                @if(str_contains(request()->url(), 'support') == true)
                                <img src="{{ asset('assets/12FlyIcons/supportactiveicon2x.png') }}" width="30"
                                    height="30" alt="">
                                @else
                                <img src="{{ asset('assets/12FlyIcons/supporticon2x.png') }}" width="20" height="20"
                                    alt="">
                                @endif
                            </span>
                            <span class="sidebar-menu-text">Support</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="support">
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/faqs') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('support.faqs') }}">
                                    <span class="sidebar-menu-text">FAQs</span>
                                </a>
                            </li>
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/guides-and-links') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('support.guides') }}">
                                    <span class="sidebar-menu-text">Guides & Links</span>
                                </a>
                            </li>
                            <li
                                class="sidebar-menu-item {{ str_ends_with(request()->url(), '/contact-us') == true ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('support.contactUs') }}">
                                    <span class="sidebar-menu-text">Contact Us</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
