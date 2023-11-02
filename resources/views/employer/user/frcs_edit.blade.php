@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">
                    
                          <h6 class="card-title">FRCS Details</h6>
                    
                          <form class="forms-sample" method="POST" action="{{ route('employer.frcs.update',$frcs->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Name</label>
                                <div class="col-sm-3">
                                  <span>@isset($frcs->user->first_name)
                                    {{$frcs->user->first_name.' '.$frcs->user->last_name}}
                                  @endisset</span>
                                  <input type="hidden" name="employee_id" value="{{$employee->id}}">
                                </div>
                              </div>
                           
                          
                            
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Year To Date Normal Pay <span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('yeartodate_normal_pay')) is-invalid @endif"
                                    name="yeartodate_normal_pay" value="{{old('yeartodate_normal_pay', $frcs->yeartodate_normal_pay)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('yeartodate_normal_pay') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Year To Date Dir.remuneration and bonus/overtime<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('yeartodate_dir_rem_and_bonus_overtime')) is-invalid @endif"
                                    name="yeartodate_dir_rem_and_bonus_overtime" value="{{old('yeartodate_dir_rem_and_bonus_overtime', $frcs->yeartodate_dir_rem_and_bonus_overtime)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('yeartodate_dir_rem_and_bonus_overtime') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Year To Date Redundancy Payments<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('yeartodate_redundancy_payments')) is-invalid @endif"
                                    name="yeartodate_redundancy_payments" value="{{old('yeartodate_redundancy_payments', $frcs->yeartodate_redundancy_payments)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('yeartodate_redundancy_payments') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Year To Date Lumpsum Payments<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('yeartodate_lumpsum_payments')) is-invalid @endif"
                                    name="yeartodate_lumpsum_payments" value="{{old('yeartodate_lumpsum_payments', $frcs->yeartodate_lumpsum_payments)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('yeartodate_lumpsum_payments') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Year To Date Other One off Payments<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('yeartodate_other_one_off_payments')) is-invalid @endif"
                                    name="yeartodate_other_one_off_payments" value="{{old('yeartodate_other_one_off_payments', $frcs->yeartodate_other_one_off_payments)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('yeartodate_other_one_off_payments') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Year To Date Income Tax<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('yeartodate_income_tax')) is-invalid @endif"
                                    name="yeartodate_income_tax" value="{{old('yeartodate_income_tax', $frcs->yeartodate_income_tax)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('yeartodate_income_tax') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Year To Date SRT<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('yeartodate_srt')) is-invalid @endif"
                                    name="yeartodate_srt" value="{{old('yeartodate_srt', $frcs->yeartodate_srt)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('yeartodate_srt') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Year To Date ECAL<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('yeartodate_ecal')) is-invalid @endif"
                                    name="yeartodate_ecal" value="{{old('yeartodate_ecal', $frcs->yeartodate_ecal)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('yeartodate_ecal') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Normal Pay<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('normal_pay')) is-invalid @endif"
                                    name="normal_pay" value="{{old('normal_pay', $frcs->normal_pay)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('normal_pay') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Director Remuneration<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('director_remuneration')) is-invalid @endif"
                                    name="director_remuneration" value="{{old('director_remuneration', $frcs->director_remuneration)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('director_remuneration') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Bonus/Overtime<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('bonus_overtime')) is-invalid @endif"
                                    name="bonus_overtime" value="{{old('bonus_overtime', $frcs->bonus_overtime)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('bonus_overtime') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Redundancy Payment Approval No.<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('redundancy_payment_approval_no')) is-invalid @endif"
                                    name="redundancy_payment_approval_no" value="{{old('redundancy_payment_approval_no', $frcs->redundancy_payment_approval_no)}}" placeholder="Enter number" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('redundancy_payment_approval_no') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Redundancy Payments<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('redundancy_payments')) is-invalid @endif"
                                    name="redundancy_payments" value="{{old('redundancy_payments', $frcs->redundancy_payments)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('redundancy_payments') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Lumpsum Payment Approval No.<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('lumpsum_payment_approval_no')) is-invalid @endif"
                                    name="lumpsum_payment_approval_no" value="{{old('lumpsum_payment_approval_no', $frcs->lumpsum_payment_approval_no)}}" placeholder="Enter number" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('lumpsum_payment_approval_no') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Lumpsum Payment<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('lumpsum_payment')) is-invalid @endif"
                                    name="lumpsum_payment" value="{{old('lumpsum_payment', $frcs->lumpsum_payment)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('lumpsum_payment') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Other One off Payment Approval No.<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('other_oneoff_payment_approval_no')) is-invalid @endif"
                                    name="other_oneoff_payment_approval_no" value="{{old('other_oneoff_payment_approval_no', $frcs->other_oneoff_payment_approval_no)}}" placeholder="Enter number" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('other_oneoff_payment_approval_no') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Other One off Payment<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('other_oneoff_payment')) is-invalid @endif"
                                    name="other_oneoff_payment" value="{{old('other_oneoff_payment', $frcs->other_oneoff_payment)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('other_oneoff_payment') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">FNPF Deduction<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('fnpf_deduction')) is-invalid @endif"
                                    name="fnpf_deduction" value="{{old('fnpf_deduction', $frcs->fnpf_deduction)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('fnpf_deduction') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Gross up Employee<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('gross_up_employee')) is-invalid @endif"
                                    name="gross_up_employee" value="{{old('gross_up_employee', $frcs->gross_up_employee)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('gross_up_employee') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Income Tax<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('income_tax')) is-invalid @endif"
                                    name="income_tax" value="{{old('income_tax', $frcs->income_tax)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('income_tax') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">SRT<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('srt')) is-invalid @endif"
                                    name="srt" value="{{old('srt', $frcs->srt)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('srt') }}</div>
                            </div>
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">ECAL<span class="col-sm-3 text-danger"></span></label>
                                <input type="text"
                                    class="col-sm-3 form-control @if ($errors->has('ecal')) is-invalid @endif"
                                    name="ecal" value="{{old('ecal', $frcs->ecal)}}" placeholder="Enter value" >
                                <div class="invalid-feedback col-sm-2">{{ $errors->first('ecal') }}</div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success me-2">Submit</button>
                            {{-- <button class="btn btn-danger" fdprocessedid="bbrcxd">Delete</button> --}}
                          </form>
                    
                        </div>
                      </div>

        </div>
    </div>


@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
   
@endpush
