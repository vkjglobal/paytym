@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">TestPayment</h6>
                    
                    <div>
						<div>
							<div class="table-responsive">
								<table id="dataTableExample" class="table">
									<thead>
										<tr>

											<th>Plan</th>
											<th>Description</th>
											{{-- <th>Status</th> --}}
											<th>Amount</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>Small</th>
											<th>6 to 40	 people</th>
											{{-- <th>Pending</th>  --}}
											<th>$30</th>
										</tr>
									</tbody>
								</table>	
						</div>	
						
						<form
								name="myform" action="{{route('employer.billing.pay')}}" method="POST" class="m-4">
								@csrf
								<input type="hidden" id="nar_msgType" name="nar_msgType" value="AR" class="m-2">
								<input type="hidden" id="nar_merTxnTime" name="nar_merTxnTime" value="20200928231710" class="m-2">
								<input type="hidden" id="nar_merBankCode" name="nar_merBankCode" value="01" class="m-2">
								<input type="hidden" id="nar_orderNo" name="nar_orderNo" value="ORD_20200928231710" class="m-2"/>
								<input type="hidden" id="nar_merId" name="nar_merId" value="840000008400001" class="m-2"/> 
								<input type="hidden" id="nar_txnCurrency" name="nar_txnCurrency" value="242" class="m-2"/>
								<input type="hidden" id="nar_txnAmount" name="nar_txnAmount" value="30.00" class="m-2"/>
								<input type="hidden" id="nar_remitterEmail" name="nar_remitterEmail"
								value="paytym@gmail.com" class="m-2"/>
								<input type="hidden" id="nar_remitterMobile" name="nar_remitterMobile" value="6798112040"class="m-2"/>
								<input type="hidden" id="nar_cardType" name="nar_cardType" value="EX"class="m-2"/> 
								<input type="hidden"
								id="nar_checkSum" name="nar_checkSum"
								value="2151CF6C22A3D0E035FEFAD70B52D77DB23F1ECDB4B45D8FB701F3DDE257664A3C232E09AB
								CF12E5D2D0C7A760AA63580DC9E68F61669DD10B53C3C662711D7682F5FFC4A9E0C0A9BC9121CBC
								9913200BB2F46FC1247D66B01F2E1AA76BE35CD5FB965AE7E998D334A0544FA1480FF18AA78C1D6E
								D2390CA3851AAB5DC75A36C6019588AF6F5948D446BAAD67FC904E3195D6B6F727A143C07A8995BF
								73DF1D9F977240B93BE6DF6AF5F74475EC7F9BCE54204A4AB47B2E30377F6F560BA0513925D84BCB
								00183FD6137E560B1732565A811B66690EEC2A461567239EB28A50AB8AC61255E0FAAF8454F578A0B
								DD5B49EDB757CAC69A14BC983DF67EAB118F07"class="m-2"/>
								<input type="hidden" id="nar_paymentDesc" name="nar_paymentDesc" value="TestPayment"class="m-2"/>
								<input type="hidden" id="nar_version" name="nar_version" value="1.0"class="m-2"/>
								<input type="hidden" id="nar_mcccode" name="nar_mcccode" value="4112"class="m-2"/>
								<input type="hidden" id="nar_returnUrl" name="nar_returnUrl" value="http://127.0.0.1:8000/pay"class="m-2"/>
								<input type="hidden" id="nar_Secure" name="nar_Secure" value="IPGSECURE"class="m-2"/>
								<div class="d-grid gap-2 col-4 mx-auto">
									<input type="submit" value="Pay" class="btn btn-lg btn-success m-3 ">
								</div>	
								{{-- <input type="hidden" id="Referral_Url" name="Referral_Url" value="	https://uat2.yalamanchili.in/pgsim/sandtest.html" class="m-2"/>
								<input type="hidden" id="req_source_string" name="req_source_string" value="" class="m-2"/>
								<input type="hidden" id="req_status" name="req_status" value="" class="m-2"/>
								<input type="hidden" id="Referral_Url_validation" name="Referral_Url_validation" value="" class="m-2"/>
								<input type="hidden" id="checksum_valid" name="nar_returnUrl" value="" class="m-2"/> --}}


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
