@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

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
											
											{{--<td>@if($plan->status == 0 || $plan->status==2)
												<form action="{{Route('employer.pay_invoice',  ['id' => $plan->id])}}" method="get">
													@csrf
												<input type="hidden" name="plan_id" value="{{$plan->plan->id}}">
												<button class="btn btn-success" type="submit" > 
												Pay Now
												</button>
												</form>
												
												@endif
											</td>--}}
											<td>
											@if($plan->status == 0 || $plan->status==2)
												<a href="{{ route('employer.pay_invoice', ['id' => $plan->id]) }}" type="button" class="btn btn-success">Pay Now</a>
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
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endpush
@push('custom_js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/ecfd9b3c91.js" crossorigin="anonymous"></script>
    <script src="{{asset('home_assets/js/app.js')}}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script> -->
    <script src="{{asset('home_assets/js/owl.carousel.min.js')}}"></script>    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>    
    @push('custom_js')
<script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>

@endpush
