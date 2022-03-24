
<style>
    [dir=ltr] .dropdown-menu {
        padding: 0;
    }

    [dir=ltr] .navbar.navbar-expand-sm .dropdown-menu {
        overflow: auto;
    }

    [dir=ltr] .navbar-company-menu.dropdown-menu-right {
        right: 0px !important;
    }
</style>
<div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
    <div class="mdk-header__content">

        <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-primary pl-md-0 pr-0" id="navbar" data-primary>
            <div class="container-fluid pr-0 ">

                <!-- Navbar toggler -->
                <button class="navbar-toggler navbar-toggler-custom d-lg-none d-flex mr-navbar" type="button"
                        data-toggle="sidebar">
                    <span class="material-icons">short_text</span>
                </button>

                <div class="d-flex sidebar-account flex-shrink-0 mr-auto mr-lg-0">
                    <a href="{{ route('dashboard') }}" class="flex d-flex align-items-center text-underline-0">
                        <span class="mr-1  text-white">
                            <!-- LOGO -->
                            <img src="{{ asset('assets/12FlyIcons/12FlyLogoWhite.png') }}" alt="">
                        </span>
                    </a>
                </div>
                <ul class="ml-auto nav navbar-nav mr-2 d-none d-lg-flex">
                </ul>
                <form class="search-form search-form--light d-none d-sm-flex flex ml-3"
                      action="{{ route('dashboard') }}">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                </form>
                {{--                @dd(config('app.active_operator_type'))--}}
                <div class="dropdown" style="width: 270px">
                    <a href="#account_menu"
                       class="dropdown-toggle navbar-toggler navbar-toggler-dashboard border-left d-flex align-items-center ml-navbar"
                       data-toggle="dropdown">
                        @if(session()->get('active_operator_type')[0] == 'i')
                            <span class="avatar avatar-sm mr-2">
                                <span
                                    class="avatar-title rounded-circle bg-soft-secondary text-muted">
                                    I
                                </span>
                            </span>
                            <span class="ml-1 d-flex-inline">
                                <span class="text-light">Individual</span>
                            </span>
                        @else
                            <span class="avatar avatar-sm mr-2">
                                <span
                                    class="avatar-title rounded-circle bg-soft-secondary text-muted">
                                    O
                                </span>
                            </span>
                            <span class="ml-1 d-flex-inline">
                                <span
                                    class="text-light">{{ getActiveOperatorType()  }}</span>
                            </span>
                        @endif
                    </a>
                    <style>
                        [dir=ltr] .dropdown-toggle::after {
                            display: none;
                        }
                    </style>
                    @if(isset(auth()->user()->organisation->name))
                        <style>
                            [dir=ltr] .dropdown-toggle::after {
                                display: inline-block;
                                margin-left: 0.255em;
                                vertical-align: 0.255em;
                                content: "";
                                border-top: 0.3em solid;
                                border-right: 0.3em solid transparent;
                                border-bottom: 0;
                                border-left: 0.3em solid transparent;
                            }
                        </style>
                        <div id="company_menu" class="dropdown-menu dropdown-menu-right navbar-company-menu">
                            @foreach(profiles() as $key => $profile)
                                <div class="dropdown-item d-flex align-items-center py-2 navbar-company-info py-3">
                            <span class="mr-3">
                            </span>
                                    <span class="flex d-flex flex-column">
                                    <a href="{{ route('profile-switch', $key) }}">
                                        <strong style="font-size: 16px;"
                                                class="h5 m-0">{{ $profile['name'] }}</strong></a>
                                </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
