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
                    <h6 class="card-title">Invoice</h6>
                    <div>
						<div>
							<div class="table-responsive">
								<table id="dataTableExample" class="table">
									<thead>
										<tr>
											<th>Plan</th>
											<th>Range</th>
											<th>Date</th>
											<th>Active Employees</th>
											<th>Rate Per Employee</th>
											<th>Rate Per Month</th>
											<th>Total Amount</th>
											<th>Status</th>
											<th></th>
											<th>Invoice</th>
										</tr>
									</thead>
									<tbody>
									@foreach ($plan as $key => $plan)
									<tr>
											<td>{{$plan->plan->plan}}</td>
											<td>{{$plan->plan->range_from}} to {{$plan->plan->range_to}} people</td>
											<th>@if(!is_null($plan->date))
												{{\Carbon\Carbon::parse($plan->date)->format('d-m-Y') }}
												@else
                                            No data
                                            @endif</td>
											<td>{{$plan->active_employees}}</td>
											<td>${{$plan->plan->rate_per_employee}}</td>
											<td>${{$plan->plan->rate_per_month}}</td>
											<td>${{$plan->amount}}</td>
											{{--<td><span class="btn btn-{{ optional($plan)->status == '0' ? 'danger' : 'success' }}">{{ optional($plan)->status == '0' ? 'Pending' : 'Paid' }}	</span></td>--}}
											<td><span class="btn btn-{{ optional($plan)->status == '0' ? 'secondary' :  (optional($plan)->status == '1' ? 'success' : 'danger') }}">{{ optional($plan)->status == '0' ? 'Pending' : (optional($plan)->status == '1' ? 'Paid' : 'Overdue') }}</span></td>
											<!-- <a href="{{ route('employer.view_invoice', ['id' => $plan->id]) }}">Link</a> -->
											
											<td>@if($plan->status == 0 || $plan->status==2)
												<form action="{{Route('employer.billing')}}" method="post">
													@csrf
												<input type="hidden" name="plan_id" value="{{$plan->plan->id}}">
												<button class="btn btn-success" type="submit" > 
												Pay Now
												</button>
												<td><a href="https://paytym.net/" type="button" class="btn btn-primary">Pay</a></td>

												</form>
												
												@endif
											</td>
												<td><a href="{{ route('employer.view_invoice', ['id' => $plan->id]) }}" type="button" class="btn btn-primary">View</a></td>
											<th></td>
										</tr>
										@endforeach
									</tbody>
								</table>	
						</div>	
						
					<form name="myform" action="https://uat2.yalamanchili.in/MPI_v1/mercpg" method="POST" class="m-4">
						@csrf
						<input type="hidden" id="nar_msgType" name="nar_msgType" value="AR" />
						<input type="hidden" id="nar_merTxnTime" name="nar_merTxnTime" value="202312323160" />
						<input type="hidden" id="nar_merBankCode" name="nar_merBankCode" value="01" />
						<input type="hidden" id="nar_orderNo" name="nar_orderNo" value="ORD_202312323160" />
						{{-- <input type="hidden" id="nar_merId" name="nar_merId" value="842700008427001" /> --}}
						<input type="hidden" id="nar_merId" name="nar_merId" value="853000008530001" />
						<input type="hidden" id="nar_txnCurrency" name="nar_txnCurrency" value="242" />
						<input type="hidden" id="nar_txnAmount" name="nar_txnAmount" value="20.00" />
						<input type="hidden" id="nar_AcquirerPaymentReferenceNumber" name="nar_AcquirerPaymentReferenceNumber" value="99YYYXXXXXXXXXXX" />
						{{-- <input type="hidden" id="nar_PrivateData1" name="nar_PrivateData1" value="" />
						<input type="hidden" id="nar_PrivateData2" name="nar_PrivateData2" value="" />
						<input type="hidden" id="nar_PrivateData3" name="nar_PrivateData3" value="" /> --}}
						<input type="hidden" id="nar_remitterEmail" name="nar_remitterEmail" value="paytym@gmail.in" />
						<input type="hidden" id="nar_remitterMobile" name="nar_remitterMobile" value="8879873728" />
						<input type="hidden" id="nar_cardType" name="nar_cardType" value="EX" />
						<input type="hidden" id="nar_checkSum" name="nar_checkSum" value="" />
						<input type="hidden" id="nar_paymentDesc" name="nar_paymentDesc" value="Merchant Simulator Test Txn" />
						<input type="hidden" id="nar_version" name="nar_version" value="1.0" />
						<input type="hidden" id="nar_merflag" name="nar_merflag" value="S" />
						<input type="hidden" id="nar_mcccode" name="nar_mcccode" value="4112" />
						<input type="hidden" id="nar_returnUrl" name="nar_returnUrl" value="http://127.0.0.1:8000/employer/billing/plan" />
						<input type="hidden" id="Referral_Url" name="Referral_Url" value="" />

						<input type="hidden" id="req_source_string" name="req_source_string" value="" />
						<input type="hidden" id="req_status" name="req_status" value="" />
						<input type="hidden" id="Referral_Url_validation" name="Referral_Url_validation" value="" />
						<input type="hidden" id="checksum_valid" name="nar_returnUrl" value="" />

						<div class="row pt-3 pb-5 mb-2">
						
						<!-- <div class="col-sm-6 mb-3">
							<button id="btnpage" class="btn btn-style-1 btn-primary btn-block" >
							<i class="fe-icon-credit-card"></i>Checkout</button>
						</div> -->
					</div>


    </div>
							
	</form>
								
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

    @notifyJs

    @stack('custom_js')

    </body>

</html>