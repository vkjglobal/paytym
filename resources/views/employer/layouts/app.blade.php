<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paytym | Employer</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/core/core.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin_assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/demo_1/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.png') }}" />
    <!-- custom styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@notifyCss
<link rel="stylesheet" href="{{ asset('vendor/mckenziearts/laravel-notify/css/notify.css') }}">

    <style>
        .notify {
            z-index: 999999999 !important;
        }
        .select2-container {
        width: 100% !important; /* Set the width to 100% to fix the alignment problem */
        z-index: 99999; /* Set a higher z-index to ensure the dropdown appears on top of other elements */
        }
        .select2-container .select2-selection--single {
            height: 38px !important; /* Adjust the height of the Select2 dropdown to match the height of the input field */
        }
        .select2-container--bootstrap .select2-selection--single {
            padding: 6px 12px !important; /* Adjust the padding of the Select2 dropdown to match the padding of the input field */
        }
        .select2-container .select2-selection--single .select2-selection__arrow {
            top: 10px !important; /* Adjust the position of the arrow to align it with the input field */
        }
        


        .select2-selection__arrow {
            display: none !important;
        }

        .btn-fixed-width {
         width: 100px !important; /* Set the width to the desired value and add !important flag */
        }
        .form-check.chk-bx-typ2 .form-check-label{
            position: relative;
        }
        .form-check.chk-bx-typ2 .form-check-label::before{
            content: "";
            width: 18px;
            height: 18px;
            position: absolute;
            left: -25px;
            top: 0;
            border-radius: 2px;
            border: solid #727cf5;
            border-width: 2px;
            -webkit-transition: all;
            -moz-transition: all;
            -ms-transition: all;
            -o-transition: all;
            transition: all;
            transition-duration: 0s;
            -webkit-transition-duration: 250ms;
            transition-duration: 250ms;
        }
        .form-check.chk-bx-typ2 input[type="checkbox"]{
            opacity: 0;
        }
        .form-check.chk-bx-typ2 input[type="checkbox"]:checked ~ .form-check-label::before{
            background: #727cf5;
            border-width: 0;
        }
        .form-check.chk-bx-typ2 .form-check-label:after {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            left: -25px;
            top: 0;
            -webkit-transition: all;
            -moz-transition: all;
            -ms-transition: all;
            -o-transition: all;
            transition: all;
            transition-duration: 0s;
            -webkit-transition-duration: 250ms;
            transition-duration: 250ms;
            font-family: feather;
            content: '\e83f';
            opacity: 0;
            font-size: .9375rem;
            font-weight: bold;
            color: #ffffff;
        }
        .form-check.chk-bx-typ2 input[type="checkbox"]:checked ~ .form-check-label:after {
            width: 18px;
            opacity: 1;
            line-height: 18px;
        }
    </style>


    @stack('custom_css')
</head>


<body>
    <div class="main-wrapper">

        @if (auth()->guard('employer')->user())
            <!-- partial:partials/_sidebar.html -->
            @include('employer.layouts.partials.sidebar')
            <!-- partial -->
        @endif

        <div class="page-wrapper">

            @if (auth()->guard('employer')->user())
                <!-- partial:partials/_navbar.html -->
                @include('employer.layouts.partials.header')
                <!-- partial -->
            @endif

            <div class="page-content">

                <!-- Content -->
                @yield('content')
                <!-- Content -->

            </div>

            @if (auth()->guard('employer')->user())
                <!-- _footer -->
                @include('employer.layouts.partials.footer')
                <!-- _footer -->
            @endif

        </div>
        @include('notify::components.notify')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- core:js -->
    <script src="{{ asset('admin_assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ asset('admin_assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <!-- end plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin_assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- custom js for this page -->
    <script src="{{ asset('admin_assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('admin_assets/js/datepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- end custom js for this page -->
    <!-- custom js -->

    @notifyJs

    @stack('custom_js')
</body>

</html>
