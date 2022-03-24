<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>@yield('title')</title>
    @includeIf('partial.head')
    @yield('style')
    <style>
/* Optional: Makes the sample page fill the window. */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}
#target {
  width: 345px;
}

    </style>
      <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvrWwydlLEhYsmISJ4OEP1HesTuSTOyD8&libraries=places&callback=initAutocomplete" async defer></script>-->
</head>

<body class="layout-default">
<!-- Modals Buttons -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#success-modal" id="success"
        style="display: none">Login Modal
</button>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#error-modal" id="error"
        style="display: none">Login Modal
</button>
<!-- End Modals Buttons -->

<!-- Header Layout -->
<div class="mdk-header-layout js-mdk-header-layout">

    <!-- Header -->
@includeIf('partial.header')
<!-- // END Header -->

    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content">

        <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page">

                @yield('content')

                <footer>
                    <div class="container-fluid page__heading-container" style="margin-top: -15px">
                        <img src="{{ asset('assets/12FlyIcons/12FlyLogoGrey.png') }}" width="80px" height="30px">
                        <span style="font-size: 12px">Copyright @ 2022 CIVIL AVIATION AUTHORITY MALAYSIA (CAAM). All Rights Reserved.
                                <a href="#">Terms and Conditions</a> <a href="#">Privacy Policy</a></span>
                    </div>
                </footer>
            </div>
            <!-- // END drawer-layout__content -->
            @includeIf('partial.sidebar')
        </div>
        <!-- // END drawer-layout -->

    </div>
    <!-- // END header-layout__content -->

</div>
<!-- // END header-layout -->


<!-- App Settings FAB -->
<div id="app-settings">
    <app-settings layout-active="default" :layout-location="{
      'default': 'student-dashboard.html',
      'fixed': 'fixed-student-dashboard.html',
      'fluid': 'fluid-student-dashboard.html',
      'mini': 'mini-student-dashboard.html'
    }"></app-settings>
</div>

@includeIf('partial.footer')

@yield('script')
@livewireScripts

@if(session()->has('success'))
    <script>
        window.addEventListener('load', (event) => {
            document.getElementById('success').click();
        });
    </script>
@endif

@if(session()->has('error'))
    <script>
        window.addEventListener('load', (event) => {
            document.getElementById('error').click();
        });
    </script>
@endif
@includeIf('partial.modals')
@yield('modal')

</body>

</html>
