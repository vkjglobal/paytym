@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Deduction Report</h6>
                    
                    <div class="float-right mb-3">
                        {{-- <button type="button" class="btn btn-outline-primary btn-icon-text">
                            <i class="btn-icon-prepend" data-feather="printer"></i>
                            Print
                          </button> --}}
                          <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.report.deduction.export")}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                          </button> 
                    
                    </div>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                     
                                    <th>Total Deduction Amount</th>
                                    {{--<th>Deduction Type</th>
                                    <th>Date</th>--}}

                                    <th>View</th>
                   
                                    {{-- <th>Total Allowance</th>    --}}
                                    {{-- <th>Branch</th>
                                    <th>Department</th>
                                    <th>Status</th> --}}

                                    {{-- <th>Date of birth</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Salary type</th>
                                    <th>Pay period</th>

                                    <th>Attendance(Days)</th>
                                    <th>Leaves(Days)</th>
                                    <th>Projects</th>
                                    <th>Employment start date</th>
                                    <th>Employment end date</th> --}}

                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@isset($employee->first_name)
                                            {{ $employee->first_name }}
                                        @endisset</td>
                                        <td>
                                            {{ $employee->total_deduction() }}
                                        </td>
                                        {{--<td>
                                            {{ optional($employee->assign_deduction)->deduction->name ?? "" }}
                                           
                                        </td>
                                        <td>
                                            {{ $employee->total_deduction() }}
                                        </td>--}}
                                        <td>
                                            <a href="{{route('employer.report.deduction.view', $employee->id)}}"><i data-feather="eye"></i></a>
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
