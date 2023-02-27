@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Attendance Report</h6>
                    
                    <div>
                        <form method="POST" action="{{ route('employer.report.attendance.filter') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row" id="" >
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="control-label">Employee<span class="text-danger">*</span></label>
                                        <select name="employee" class="@if ($errors->has('employee')) is-invalid @endif" >
                                            <option selected="true" >All User</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->first_name}}</option>
                                            @endforeach
                                        </select>                                
                                        <div class="invalid-feedback">{{ $errors->first('employee') }}</div>
                                    </div>
                                </div><!-- Col -->
                            {{-- </div><!-- Row --> --}}
                              
                            {{-- <div class="row"> --}}
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">From <span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @if ($errors->has('user_rate')) is-invalid @endif"
                                            name="date_from" value="" placeholder="Enter Date" >
                                        <div class="invalid-feedback">{{ $errors->first('date_from') }}</div>
                                    </div>
                                </div><!-- Col --> 
                            {{-- </div><!-- Row --> --}}
        
                            {{-- <div class="row"> --}}
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">To<span class="text-danger"></span></label>
                                        <input type="date"
                                            class="form-control @if ($errors->has('date_to')) is-invalid @endif"
                                            name="date_to" value="" placeholder="Enter Rate" >
                                        <div class="invalid-feedback">{{ $errors->first('date_to') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-2"> 
                                <button class="btn btn-info mt-4 p-2  ">Filter</button>
                                </div>
                            </div><!-- Row -->
        
                            {{-- <input type="submit" class="btn btn-info submit float-right" value="Filter"> --}}
                            
                        </form>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Hours worked</th>
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
                                        <td>{{ $employee->attendanceReport($date_from, $date_to) }}</td>
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
                                        {{-- <td>{{ $attendances }}</td> --}}
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
