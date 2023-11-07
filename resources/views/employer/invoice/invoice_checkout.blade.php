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
        <div class="col-md-6">
            {{--<div class="card">
                <div class="card-body">--}}
                   {{-- <h6 class="card-title"> Update Card</h6>--}}

                    {{--<form method="POST" action="" enctype="multipart/form-data">--}}
                    <form name="myform" action="https://uat2.yalamanchili.in/MPI_v1/mercpg" method="POST" class="m-4">
						@csrf
                        <input type="hidden" id="nar_msgType" name="nar_msgType" value="AR" />
						{{--<input type="hidden" id="nar_merTxnTime" name="nar_merTxnTime" value="202312323160" />--}}
						<input type="hidden" id="nar_merTxnTime" name="nar_merTxnTime" value="{{ date('YmdHis') }}" />
						<input type="hidden" id="nar_merBankCode" name="nar_merBankCode" value="01" />
						{{--<input type="hidden" id="nar_orderNo" name="nar_orderNo" value="ORD_{{ $invoice->invoice_number }}" />--}}
						<input type="hidden" id="nar_orderNo" name="nar_orderNo" value="ORD_<?php echo date('YmdHis'); ?>" />
                        
						<input type="hidden" id="nar_merId" name="nar_merId" value="876500008765001" />
						<input type="hidden" id="nar_txnCurrency" name="nar_txnCurrency" value="242" />
						<input type="hidden" id="nar_txnAmount" name="nar_txnAmount" value="{{ $invoice->amount}}" />
						<input type="hidden" id="nar_remitterEmail" name="nar_remitterEmail" value="{{$employer->email}}" />
						<input type="hidden" id="nar_remitterMobile" name="nar_remitterMobile" value="{{$employer->phone}}" />
						<input type="hidden" id="nar_cardType" name="nar_cardType" value="EX" />
                        
						
                        <input type="hidden" id="nar_checkSum" name="nar_checkSum" value="{{ $checksumkey }}" />{{--<?php echo bin2hex($binary_signature) ?>--}}
						{{--<input type="hidden" name="nar_checksum" value="{{<?php echo bin2hex($binary_signature); ?>}}">--}}
						<input type="hidden" id="nar_paymentDesc" name="nar_paymentDesc" value="Merchant Simulator Test Txn" />
						<input type="hidden" id="nar_version" name="nar_version" value="1.0" />
						<input type="hidden" id="nar_merflag" name="nar_merflag" value="S" />{{--{{ session('okvalue') }}--}}
						<input type="hidden" id="nar_mcccode" name="nar_mcccode" value="8931" />
						{{--<input type="hidden" id="nar_returnUrl" name="nar_returnUrl" value="https://uat2.yalamanchili.in/pgsim/checkresponse"/>--}}
						<input type="hidden" id="nar_returnUrl" name="nar_returnUrl" value="https://paytym.net/employer/checkresponse"/>
						<input type="hidden" id="nar_Secure" name="nar_Secure" value="IPGSECURE"/> 

                       {{-- @csrf
                        @method('PUT')--}}
                        {{--<div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <h3 class="card-title"><u>Card Details</u></h3>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Card Number <span class="text-danger">*</span></label>
                                    @if( optional($card)->primary_is_default == 1)
                                     
                                        <?php
                            function getTruncatedCreditCNumber($ccNum){
                                return str_replace(range(0,9), "*", substr($ccNum, 0, -4)) .  substr($ccNum, -4);
                            }
                                ?>
                                <input type="text"
                                        class="form-control @if ($errors->has('primary_card_number')) is-invalid @endif"
                                        name="primary_card_number" value="{{ old('primary_card_number') }},  <?php echo getTruncatedCreditCNumber(optional($card)->primary_card_number); ?> " placeholder="Enter Card Number" required>
                                    <div class="invalid-feedback">{{ $errors->first('primary_card_number') }}</div>
                                    @else
                                   
                                        <?php
                            function getTruncatedCCNumber1($ccNum){
                                return str_replace(range(0,9), "*", substr($ccNum, 0, -4)) .  substr($ccNum, -4);
                            }
                                ?>
                                <input type="text"
                                        class="form-control @if ($errors->has('secondary_card_number')) is-invalid @endif"
                                        name="secondary_card_number" value="{{ old('secondary_card_number') }},  <?php echo getTruncatedCCNumber1(optional($card)->secondary_card_number); ?> " placeholder="Enter Card Number" required>
                                    <div class="invalid-feedback">{{ $errors->first('secondary_card_number') }}</div>
                                    @endif
                                 
                                </div>
                               

 
    
 
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name on Card <span class="text-danger">*</span></label>
                                  
                                  @if( optional($card)->primary_is_default == 1)
                                    <input type="text"
                                        class="form-control @if ($errors->has('primary_name_on_card')) is-invalid @endif"
                                        name="primary_name_on_card" value="{{ old('primary_name_on_card', optional($card)->primary_name_on_card) ?? '' }}"
                                        placeholder="Enter Card Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('primary_name_on_card') }}</div>
                                    @else
                                    <input type="text"
                                        class="form-control @if ($errors->has('secondary_name_on_card')) is-invalid @endif"
                                        name="secondary_name_on_card" value="{{ old('secondary_name_on_card', optional($card)->secondary_name_on_card) ?? '' }}"
                                        placeholder="Enter Card Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('secondary_name_on_card') }}</div>
                                    @endif
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date<span class="text-danger">*</span></label>
                                    
                                    @if( optional($card)->primary_is_default == 1)
                                    <input type="text"
                                        class="form-control @if ($errors->has('primary_expiry_date')) is-invalid @endif"
                                        name="primary_expiry_date" value="{{ old('primary_expiry_date', optional($card)->primary_expiry_date) ?? '' }}"
                                        placeholder="MM/YYYY" required>
                                       <div class="invalid-feedback">{{ $errors->first('primary_expiry_date') }}</div>
                                       @else
                                       <input type="text"
                                        class="form-control @if ($errors->has('secondary_expiry_date')) is-invalid @endif"
                                        name="secondary_expiry_date" value="{{ old('secondary_expiry_date', optional($card)->secondary_expiry_date) ?? '' }}"
                                        placeholder="MM/YYYY" required>
                                       <div class="invalid-feedback">{{ $errors->first('secondary_expiry_date') }}</div>
                                       @endif
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">CVV <span class="text-danger">*</span></label>
                                        <input type="text"
                                        class="form-control @if ($errors->has('cvv')) is-invalid @endif"
                                        name="cvv" value="{{ old('cvv') }}" placeholder="Enter CVV" required>
                                    <div class="invalid-feedback">{{ $errors->first('cvv') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                    </div>
                </div>--}}
            </div>
                        
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><br>
                                <h3 class="card-title"><u>Invoice Details</u></h3>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Invoice Number <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('invoice_number')) is-invalid @endif"
                                        name="invoice_number" value="{{ old('invoice_number',$invoice->invoice_number) }}" disabled required>
                                    <div class="invalid-feedback">{{ $errors->first('invoice_number') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('company')) is-invalid @endif"
                                        name="company" value="{{ old('company',$invoice->employer->company) }}" disabled required>
                                    <div class="invalid-feedback">{{ $errors->first('company') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Plan <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('plan')) is-invalid @endif"
                                        name="plan" value="{{ old('plan',$invoice->plan->plan) }}" disabled required>
                                        
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Total Amount <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('amount')) is-invalid @endif"
                                        name="amount" value="${{ old('amount',$invoice->amount) }}" disabled required>
                                        
                                </div><br>
                            </div><!-- Col -->
                        </div><!-- Row -->

                       

                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3 stretch-card" style="text-align:right">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                            <div class="col-sm-6" >
                                <div class="form-group">
                                </div>
                                <button type="submit" class="btn btn-primary submit">Proceed To Pay</button>
                   
                            </div><!-- Col -->
                        </div><!-- Row --> 
                    </form>
</div></div></div>

    </div></div>
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

    @notifyJs

    @stack('custom_js')

    </body>

</html>
