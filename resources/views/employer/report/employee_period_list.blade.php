@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Employment Period</h6>
                    
                    <div class="float-right mb-3">
                        {{-- <button type="button" class="btn btn-outline-primary btn-icon-text">
                            <i class="btn-icon-prepend" data-feather="printer"></i>
                            Print
                          </button> --}}
                          <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.report.employment_period.export")}}'">
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
                                    <th>Buisness</th>
                                    <th>Branch</th>
                                    <th>Department</th>
                                    <th>Employment start date</th>
                                    <th>Employment end date</th>

                                    {{-- <th>Check-in time</th>
                                    <th>Check-out time</th>
                                    <th>Status</th>
                                </tr> --}}
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@isset($employee->first_name)
                                            {{ $employee->first_name }}
                                        @endisset</td>
                                        <td>@isset($employee->business->name)
                                            {{ $employee->business->name }}
                                        @endisset</td>
                                        <td>@isset($employee->branch->name)
                                            {{ $employee->branch->name }}
                                        @endisset</td>
                                        <td>@isset($employee->department->dep_name)
                                            {{ $employee->department->dep_name }}
                                        @endisset</td>
                                        <td>@isset($employee->employment_start_date)
                                            {{ $employee->employment_start_date }}
                                        @endisset</td>
                                        <td>@isset($employee->employment_end_date)
                                            {{ $employee->employment_end_date }}
                                        @endisset</td>
                                        

                                        {{-- <td>{{ $employee->attendanceReport($attendances) }}</td> --}}
                                        {{-- <td>{{ $employee->attendance->attendanceReport($employee->id, $date_from, $date_to) }}</td> --}}
                                        {{-- <td>@isset($attendance->check_in)
                                            {{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i:s') }}
                                        @endisset</td>
                                        <td>@if($attendance->check_out)
                                            {{ \Carbon\Carbon::parse($attendance->check_out)->format('H:i:s') }}
                                            @else
                                            <span class="text-center">{{'-'}}</span>
                                        @endif</td>
                                        <td>{{ $attendance->status }}</td> --}}

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
