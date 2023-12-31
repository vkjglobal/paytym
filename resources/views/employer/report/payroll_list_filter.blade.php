@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    @php
        use Carbon\Carbon;
    @endphp
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Payroll Report</h6>
                    {{-- <div class="float-right mb-3">
                          <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.report.attendance.export", $request)}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                          </button> 
                    </div> --}}

                    <div class="float-right mb-3">
                        <form action="{{route("employer.report.payroll.export")}}" method="get">
                            <input type="hidden" name="business" value="{{$request->business}}">
                            <input type="hidden" name="branch" value="{{$request->branch}}">
                            <input type="hidden" name="department" value="{{$request->department}}">
                            <input type="hidden" name="user" value="{{$request->user}}">
                            <input type="hidden" name="start_date" value="{{$request->start_date}}">
                            <input type="hidden" name="end_date" value="{{$request->end_date}}">
                            <input type="hidden" name="employer_id" value="{{$employer_id}}">
                            <button type="submit" class="btn btn-primary btn-icon-text">
                                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                                Download Report
                              </button> 
                        </form>
                    </div>
<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Name</th>
                <th>Business</th>

                <th>Base Salary</th>
                <th>Net Salary</th>
                <th>Gross Salary</th>
                <th>Paid Salary</th>

                <th>Total Tax</th>
                <th>Total Deduction</th>
                <th>Total Allowance</th>
                <th>Total Bonus</th>
                <th>Total Commission</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($payrolls as $payroll)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@isset($payroll->user->first_name)
                        {{ $payroll->user->first_name }}
                    @endisset</td>
                    <td>@isset($payroll->user->business->name)
                        {{ $payroll->user->business->name }}
                    @endisset</td>
                    <td>@isset($payroll->base_salary)
                        {{ $payroll->base_salary }}
                    @endisset</td>
                    <td>@isset($payroll->net_salary)
                        {{ $payroll->net_salary }}
                    @endisset</td>
                    <td>@isset($payroll->gross_salary)
                        {{ $payroll->gross_salary }}
                    @endisset</td>
                    <td>@isset($payroll->paid_salary)
                        {{ $payroll->paid_salary }}
                    @endisset</td>
                    <td>@isset($payroll->total_tax)
                        {{ $payroll->total_tax }}
                    @endisset</td>
                    <td>@isset($payroll->total_deduction)
                        {{ $payroll->total_deduction }}
                    @endisset</td>
                    <td>@isset($payroll->total_allowance)
                        {{ $payroll->total_allowance }}
                    @endisset</td>
                    <td>@isset($payroll->total_bonus)
                        {{ $payroll->total_bonus }}
                    @endisset</td>
                    <td>@isset($payroll->total_commission)
                        {{ $payroll->total_commission }}
                    @endisset</td>
                    <td>@isset($payroll->start_date)
                        {{ $payroll->start_date }}
                    @endisset</td>
                    <td>@isset($payroll->end_date)
                        {{ $payroll->end_date }}
                    @endisset</td>
                   
                    <td>@if($payroll->status == 0)
                            <span class="text-danger">Pending</span>
                        @else
                            <span class="text-success">Completed</span>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
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