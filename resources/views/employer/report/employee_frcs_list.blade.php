@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Employee FRCS Data Report</h6>
                    
                    {{--<div class="float-right mb-3">
                        <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.report.frcsreport.export")}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                        </button> 
                        @if(isset($request))
                        <input type="hidden" name="business" value="{{$request->business}}">
                        @endif
                    </div>--}}
                    <form method="POST" action="{{ route('employer.report.frcs.filter') }}" enctype="multipart/form-data">
                            @csrf
                    <div class="row mt-4 mb-4" id="" >
                            
                           <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Business<span class="text-danger"></span></label>
                                    <select name="business" id="business1" class="@if ($errors->has('business')) is-invalid @endif" >
                                        <option selected="true" value=" ">All Business</option>
                                        @foreach($businesses as $business)
                                            <option value="{{$business->id}}">{{$business->name}}</option>
                                        @endforeach
                                    </select>                                
                                    <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                            <div class="form-group">
                                <label for="pay-period">Pay Period</label>
                                <select id="pay-period" name="pay_period" class="form-control">
                                <option value="">All Pay Periods</option>
                                    <option value="0">Weekly</option>
                                    <option value="1">Fortnightly</option>
                                    <option value="2">Monthly</option>
                                </select>
                            </div>
                        </div>
                               
                           
                            {{--<div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Employee<span class="text-danger"></span></label>
                                    <select name="user" id="user" class="@if ($errors->has('user')) is-invalid @endif" >
                                        <option selected="true" value=" ">All Employees</option>
                                        @foreach($employees as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}}</option>
                                        @endforeach
                                    </select>                                
                                    <div class="invalid-feedback">{{ $errors->first('user') }}</div>
                                </div>
                            </div>--}}<!-- Col -->
                            <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label">Start date<span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @if ($errors->has('start_date')) is-invalid @endif"
                                            name="start_date" value="" placeholder="Enter Date" >
                                        <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                                    </div>
                                </div><!-- Col --> 
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label">End date<span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @if ($errors->has('end_date')) is-invalid @endif"
                                            name="end_date" value="" placeholder="Enter Date" >
                                        <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                                    </div>
                                </div><!-- Col --> 
                            <div class="col-sm-2"> 
                                <button class="btn btn-info mt-4 p-2" id="filter_employee">Filter</button>
                            </div>
                        </div><!-- Row -->
                        </form>

                    {{--<div class="datalist-table table-responsive">
                        <div id="employee_period_table">
                            @include('employer.report.table.employeefrcs_list_table')
                        </div>
                    </div>--}}

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
    <script>
        
    </script>
@endpush
