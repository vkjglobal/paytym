@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">
                    
                          <h6 class="card-title">Medical Details</h6>
                    
                          <form class="forms-sample">
                            <div class="row mb-3">
                                <label class="control-label col-sm-4">Name</label>
                                <div class="col-sm-3">
                                  <span>@isset($frcs->user->first_name)
                                    {{$frcs->user->first_name.' '.$frcs->user->last_name}}
                                  @endisset</span>
                                </div>
                              </div>
                              <div class="row mb-3">
                              <label class="control-label col-sm-4">Year To Date Normal Pay</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->yeartodate_normal_pay}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="control-label col-sm-4">Year To Date Dir.remuneration and bonus/overtime</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->yeartodate_dir_rem_and_bonus_overtime}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Year To Date Redundancy Payments</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->yeartodate_redundancy_payments}}</span>
                              </div>
                            </div>  
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Year To Date Lumpsum Payments</label>
                              <div class="col-sm-3">  
                                <span>{{$frcs->yeartodate_lumpsum_payments}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Year To Date Other One off Payments</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->yeartodate_other_one_off_payments}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Year To Date Income Tax</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->yeartodate_income_tax}}</span>
                              </div>
                            </div>

                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Year To Date SRT</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->yeartodate_srt}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Year To Date ECAL</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->yeartodate_ecal}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Normal Pay</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->normal_pay}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Director Remuneration</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->director_remuneration}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Bonus/Overtime</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->bonus_overtime}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Redundancy Payment Approval No.</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->redundancy_payment_approval_no}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Redundancy Payments</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->redundancy_payments}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Lumpsum Payment Approval No.</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->lumpsum_payment_approval_no}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Lumpsum Payment</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->lumpsum_payment}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Other One off Payment Approval No.</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->other_oneoff_payment_approval_no}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Other One off Payment Approval No.</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->other_oneoff_payment_approval_no}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Other One off Payment</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->other_oneoff_payment}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">FNPF Deduction</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->fnpf_deduction}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Gross up Employee</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->gross_up_employee}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">Income Tax</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->income_tax}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">SRT</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->srt}}</span>
                              </div>
                            </div>
                            <div class="row mb-3">
                            <label class="control-label col-sm-4">ECAL</label>
                              <div class="col-sm-3">
                                <span>{{$frcs->ecal}}</span>
                              </div>
                            </div>
                            <br>
                            <a href="{{ route('employer.frcs.edit', $frcs->id) }}">
                            <button type="button" class="btn btn-warning me-2" fdprocessedid="t9lgas">Edit</button>
                            </a>
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
