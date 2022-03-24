<!DOCTYPE html>
<html lang="en">

<head>
    <title>1-2Fly</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('authAssets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('authAssets/css/util.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('authAssets/css/main.css') }}" />
    <!--===============================================================================================-->
    @includeIf('partial.head')

    <style>
        .login100-form {
            width: 60%;
        }

        .login100-more {
            width: 40%;
        }

        .form-row {
            /*padding-bottom: 5px !important;*/
        }

        .login100-form {
            /*background-color: white;*/
        }

        .footer-text {
            font-size: 12px;
        }

        @media screen and (max-width: 992px) {
            .login100-form {
                width: 60%;
                padding-left: 30px;
                padding-right: 30px;
            }

            .login100-more {
                width: 40%;
            }

            .os-form-input {
                flex: 0 0 60%;
                max-width: 60%;
            }

        }

        @media screen and (max-width: 822px) {

            .os-form-input {
                flex: 0 0 65%;
                max-width: 65%;
            }

        }


        @media (max-width: 768px) {
            .login100-form {
                width: 60%;
            }

            .login100-more {
                display: block;
                width: 40%;
            }

            .os-form-input {
                flex: 0 0 80%;
                max-width: 80%;
            }
        }

        @media (max-width: 676px) {
            .login100-form {
                width: 100%;
            }

            .login100-more {
                display: none;
            }

        }

        @media screen and (max-width: 850px) {
            .footer-text, .footer-text-link {
                font-size: 11px;
            }
        }

        @media screen and (max-width: 755px) {
            .footer-text, .footer-text-link {
                font-size: 10px;
            }
        }

        @media screen and (max-width: 698px) {
            .footer-text, .footer-text-link {
                font-size: 9px;
            }
        }

        @media screen and (max-width: 639px) {
            .footer-text, .footer-text-link {
                font-size: 8px;
            }
        }

        @media screen and (max-width: 581px) {
            .footer-text, .footer-text-link {
                font-size: 7px;
            }
        }

        @media screen and (max-width: 522px) {
            .footer-text, .footer-text-link {
                font-size: 6px;
            }
        }
    </style>

    @yield('style')

</head>

<body style="background-color: #666666">
    {{--@dump(session()->has('success'))--}}
    <!-- Modals Buttons -->
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#success-modal" id="success"
        style="display: none">Login Modal
    </button>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#error-modal" id="error"
        style="display: none">Login Modal
    </button>
    <!-- End Modals Buttons -->
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                @yield('form')
                <div class="login100-more"
                    style="background-image: url({{ asset('assets/12FlyIcons/12FlyLoginSplash.jpg') }})"></div>
            </div>
        </div>
    </div>

    <footer style="padding: 7px 0;background-color: #f7f7f7">
        <div class="container-fluid page__heading-container">
{{--            <img src="{{ asset('assets/12FlyIcons/12FlyLogoGrey.png') }}" width="80px" height="30px">--}}
            <span class="footer-text">Copyright @ 2022 CIVIL AVIATION AUTHORITY MALAYSIA (CAAM). All Rights Reserved.
                <a href="#" class="footer-text-link">Terms and Conditions</a>
                <a href="#" class="footer-text-link">Privacy Policy</a></span>
        </div>
    </footer>

    <!--===============================================================================================-->
    <script src="{{ asset('authAssets/vendor/bootstrap/js/popper.js') }}"></script>


    @includeIf('partial.footer')

    @yield('script')
    @includeIf('myAuth.modals')
    @yield('modal')
    {{--<script src="{{ asset('authAssets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>--}}
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    {{--<script src="{{ asset('authAssets/js/main.js') }}"></script>--}}
</body>

</html>
