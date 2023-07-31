@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Attendance</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Check-in-time</th>
                                    <th>Extra Hours</th>
                                    <!-- <th>Status</th> -->
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@isset($attendance->user->first_name) {{ $attendance->user->first_name }}@endisset</td>
                                        <td>{{ $attendance->date }}</td>
                                        <td>{{ date('h:i A', strtotime($attendance->check_in)) }}</td>
                                        <td>{{ $attendance->extra_hours }}</td>
                                        <!-- <td>{{ date('H:i', strtotime($attendance->check_out)) }}</td> -->
                                        
                                        <!-- <td>
                                            @if($attendance->status == 1)
                                                <a href="#" class="btn btn-success">Fullday</a>
                                            @else
                                                <a href="#" class="btn btn-danger">Halfday</a>   
                                            @endif
                                        </td> -->
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Change Status button -->
                                                <form method="GET" action="{{route('employer.attendance.edit', $attendance->id)}}">
                                                    <button name="approve" type="submit" value="">
                                                        <i data-feather="edit" class="text-warning"></i>
                                                    </button>
                                                </form>
                                                <form method="post" action="{{route('employer.attendance.destroy', $attendance->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button name="approve" type="submit" value="">
                                                        <i data-feather="trash" class="text-danger"></i>
                                                    </button>
                                                </form>

                                                <!-- Change Status ends -->

                                                <!-- Delete button -->
                                                {{-- @if($leaveRequest->status != 0)
                                                    <button type="button" class="text-danger"
                                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $leaveRequest->id }}').submit();}"
                                                        data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i data-feather="trash"></i>
                                                    </button>
                                                    <form id="delete-data-{{ $leaveRequest->id }}"
                                                        action="{{ route('employer.leave.requests.delete', $leaveRequest->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @else
                                                    <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); alert('Approve or Reject request before deleting')"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash" style="color:#D3D3D3;"></i>
                                                    </button>
                                                @endif --}}
                                            </div>
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
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
@endpush
