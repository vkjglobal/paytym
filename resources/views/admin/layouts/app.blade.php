<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paytym | Admin</title>
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
    @notifyCss

    <style>
        .notify {
            z-index: 999999999 !important;
        }
        .btn-fixed-width {
         width: 100px !important; /* Set the width to the desired value and add !important flag */
    </style>

    @stack('custom_css')
</head>


<body>
    <div class="main-wrapper">

        @if (auth()->guard('admin')->user())
            <!-- partial:partials/_sidebar.html -->
            @include('admin.layouts.partials.sidebar')
            <!-- partial -->
        @endif

        <div class="page-wrapper">

            @if (auth()->guard('admin')->user())
                <!-- partial:partials/_navbar.html -->
                @include('admin.layouts.partials.header')
                <!-- partial -->
            @endif

            <div class="page-content">

                <!-- Content -->
                @yield('content')
                <!-- Content -->

            </div>

            @if (auth()->guard('admin')->user())
                <!-- _footer -->
                @include('admin.layouts.partials.footer')
                <!-- _footer -->
            @endif

        </div>

    </div>

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
    <!-- end custom js for this page -->
    <!-- custom js -->
    @notifyJs

    @stack('custom_js')
</body>

</html>
