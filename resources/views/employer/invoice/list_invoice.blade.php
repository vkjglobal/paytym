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
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('employer.home') }}" class="sidebar-brand">
            <img src="{{ asset('home_assets/images/logo.png') }}" style="max-width: 120px;" alt="PayTym" />
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
    </li>
    </ul>
    </div>
    </nav>

        <div class="page-wrapper">

            @if (auth()->guard('employer')->user())
                <!-- partial:partials/_navbar.html -->
                @include('employer.layouts.partials.header')
                <!-- partial -->
            @endif

            <div class="page-content">

            <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Invoice details</h6>
                    <div class="float-right mb-3">
                       
                         <button type="button" class="btn btn-primary btn-icon-text" onclick="downloadInvoice({{ $plan->id }})">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Invoice
                          </button> 
                         {{--  <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.download_invoice", $plan->id)}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Invoice
                          </button> --}}<a href="{{ route('employer.invoice_checkout', ['id' => $plan->id]) }}" type="button" class="btn btn-success">Pay Now</a>

                    
                    </div>
                    <div class="table-responsive">
                    <table style="width: 100%; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.2;">
    
    <tr>
            <td>
                <table style="width: 1000px; margin: 0 auto; border: 1px solid #000000; border-collapse: collapse;" id="invoiceTable">
                    <thead>
                    
                        <tr>
                            <th style="border-bottom: 1px solid #000000; padding-top: 20px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="text-align: left; font-size: 35px; font-weight: 700;">
                                            <img src="https://paytym.net/home_assets/images/logo.png" style="display: block; width: 150px;" alt="">
                                        </td>
                                    </tr>
                                 
                                    <tr>
                                        <td style="border-bottom: 5px solid #000000;">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="text-align: left; font-weight: normal; font-size: 14px; width: 33%;">
                                                        1 Regal Lane, <br>
                                                        Level 2 De Vos on the Park Building, <br>
                                                        Suva, Fiji <br>
                                                        contact@paytym.net
                                                    </td>
                                                    <td style="width: 47%;"></td>
                                                    <td style="text-align: left; vertical-align: bottom; font-weight: normal; width: 20%;">
                                                        <strong>Invoice No.: {{$plan->invoice_number }}</strong>  <br>
                                                        <strong>Date:</strong> {{ $plan->date }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 50%;">
                                    <tr>
                                        <td style="vertical-align: top; text-align: left; font-weight: bold;">Bill To:</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">
                                            {{ $employer->company }} <br>
                                            {{ $employer->street }}, <br>
                                            {{ $employer->city }}  - {{ $employer->postcode }},
                                            {{ $employer->country->name }} <br>
                                           
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 50%;">
                                    <tr>
                                        <td style="vertical-align: top; text-align: left; font-weight: bold;">Plan Details:</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">
                                            Plan : <strong>{{$plan->plan->plan}} </strong> <br>
                                            Employee - Range : <strong>{{$plan->plan->range_from}} - {{$plan->plan->range_to}} </strong> <br>
                                            Rate per Employee : <strong>${{$plan->plan->rate_per_employee}} </strong>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td>
                                            <table style="width: 100%; border: 1px solid #000000; border-collapse: collapse;">
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #000000; padding: 10px 5px; width: 50%;"><strong>Description</strong></td>
                                                    <td style="text-align: right; border: 1px solid #000000; padding: 10px 5px; width: 50%;"><strong>Amount</strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">
                                                    Service Period:  <?php
                                                     $previousMonth = date('F Y', strtotime('-1 month'));?>
                                                     {{ $previousMonth }} </td>
                                                    <td style="text-align: right; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">Monthly Subscription as per Plan</td>
                                                    <td style="text-align: right; padding: 5px;">${{$plan->plan->rate_per_month}} </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">
                                                  
                                                    Rate per Employee: ${{$plan->plan->rate_per_employee}} <br>
                                                        Active No. of Employees: {{$plan->active_employees}} <br>
                                                        Total Employees Rate: ${{$plan->plan->rate_per_employee}} * {{$plan->active_employees}}
                                                    </td>
                                                    <td style="text-align: right; padding: 5px; vertical-align: bottom;">${{ number_format($total_employee_rate, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 16px; text-align: left; padding: 10px 5px; width: 50%; border-bottom: 1px solid #000000; border-top: 2px solid #000000;
                                                    "><strong>Total Tax Inclusive Amount Due</strong></td>
                                                    <td style="font-size: 16px; text-align: right; padding: 10px 5px; width: 50%; border-bottom: 1px solid #000000; border-top: 2px solid #000000;"><strong>${{ number_format($totalamount, 2) }}</strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                   {{-- <tr>
                                        <td style="font-size: 18px; font-weight: 600; padding: 10px 5px;">
                                            Payable
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; padding: 10px 5px 20px; ">
                                            <a href="https://paytym.net/employer/invoice" style="font-size: 16px; font-weight: 600; padding: 10px 5px; border: 2px solid #0818a8; background-color: #0818a8;color:white; text-decoration: none;">Pay Now</a>
                                            Click on this button, it will be redirected to the payment section.
                                        </td>
                                    </tr>--}}
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>


                    </div>
                </div>
            </div>
        </div>
</div>





            </div>

            @if (auth()->guard('employer')->user())
                <!-- _footer -->
                @include('employer.layouts.partials.footer')
                <!-- _footer -->
            @endif

        </div>

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
    
<script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
<script>
    function downloadInvoice(planId) {
        console.log('Button clicked with plan ID:', planId);
        var url = '{{ route("employer.download_invoice", ":id") }}';
        url = url.replace(':id', planId);
        //window.location = url;

        const tableContent = document.getElementById('invoiceTable').outerHTML;

        // Create a Blob containing the table HTML
        const blob = new Blob([tableContent], { type: 'text/html' });

        // Create a temporary URL to the Blob
        const url1 = window.URL.createObjectURL(blob);

        // Create a link to trigger the download
        const a = document.createElement('a');
        a.href = url1;
        a.download = 'invoice.html'; // Set the desired filename

        // Trigger a click event on the link to start the download
        a.click();

        // Release the temporary URL
        window.URL.revokeObjectURL(url1);
    }
</script>

    @notifyJs

    @stack('custom_js')

    </body>

</html>