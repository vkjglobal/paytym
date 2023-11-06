@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-6">
           {{-- <div class="card">
                <div class="card-body">--}}
                   {{-- <h6 class="card-title"> Update Card</h6>--}}

                    {{--<form method="POST" action="" enctype="multipart/form-data">--}}
                 <form name="myform" action="https://uat2.yalamanchili.in/MPI_v1/mercpg" method="POST" class="m-4">
                      {{-- <form name="myform" action="{{ route('employer.process-payment') }}" method="POST" class="m-4">--}}
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
						<input type="hidden" id="nar_returnUrl" name="nar_returnUrl" value="https://uat2.yalamanchili.in/pgsim/checkresponse"/>
						{{--<input type="hidden" id="nar_returnUrl" name="nar_returnUrl" value="{{ route('employer.transaction_status', $invoice->id) }}"/>--}}
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
                            function getTruncatedCCNum($ccNum){
                                return str_replace(range(0,9), "*", substr($ccNum, 0, -4)) .  substr($ccNum, -4);
                            }
                                ?>
                                <input type="text"
                                        class="form-control @if ($errors->has('primary_card_number')) is-invalid @endif"
                                        name="primary_card_number" value="{{ old('primary_card_number') }},  <?php echo getTruncatedCCNum(optional($card)->primary_card_number); ?> " placeholder="Enter Card Number" required>
                                    <div class="invalid-feedback">{{ $errors->first('primary_card_number') }}</div>
                                    @else
                                  
                                    <div class="invalid-feedback">{{ $errors->first('secondary_card_number') }}</div>
                                   
                                    <?php
                            function getTruncatedCCNumber($ccNum){
                                return str_replace(range(0,9), "*", substr($ccNum, 0, -4)) .  substr($ccNum, -4);
                            }
                                ?>
                                <input type="text"
                                        class="form-control @if ($errors->has('secondary_card_number')) is-invalid @endif"
                                        name="secondary_card_number" value="{{ old('secondary_card_number') }},  <?php echo getTruncatedCCNumber(optional($card)->secondary_card_number); ?> " placeholder="Enter Card Number" required>
                                @endif </div>
                               

 
    
 
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
                        </div>--}}<!-- Row -->
                    {{--</div>
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
                                        <br>
                                </div>
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

    </div>
@endsection
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
    

@endpush
