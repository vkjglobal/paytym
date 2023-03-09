@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}
    @php
        use Carbon\Carbon;
    @endphp
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Attendance Report</h6>
                    {{-- <div class="float-right mb-3">
                          <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.report.attendance.export", $request)}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                          </button> 
                    </div> --}}

                    <div class="float-right mb-3">
                        <form action="{{route("employer.report.attendance.export")}}" method="get">
                            <input type="hidden" name="business" value="{{$request->business}}">
                            <input type="hidden" name="branch" value="{{$request->branch}}">
                            <input type="hidden" name="department" value="{{$request->department}}">
                            <input type="hidden" name="user" value="{{$request->user}}">
                            <input type="hidden" name="date_from" value="{{$request->date_from}}">
                            <input type="hidden" name="date_to" value="{{$request->date_to}}">
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
                                    <th>Hours worked</th>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    {{--<th>Status</th>--}}
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@isset($employee->first_name)
                                            {{ $employee->first_name }}
                                        @endisset</td>
                                        <td>{{ $employee->attendanceReport($date_from, $date_to) }}</td>
                                        <td>@if($date_from != 0)
                                            {{ $date_from }} @else {{ $employee->employment_start_date }}
                                        @endif</td>
                                        <td>@isset($date_to) 
                                            {{ $date_to }} @else {{ Carbon::now()->format('Y-m-d') }}
                                        @endisset</td>
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
