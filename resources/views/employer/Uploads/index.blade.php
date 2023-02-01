@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Uploads</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Employer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->first_name." ".$employee->last_name }}</td>
                                        <td>@isset($employee->employer->company) {{ $employee->employer->company }}@endisset</td>
                                        {{-- @isset($job->first_name) {{ $job->first_name }}@endisset --}}
                                        {{-- <td class="status_{{$leaveRequest->id}}">
                                            @if ($leaveRequest->status == 1)
                                                <span class="btn btn-success">{{ $leaveRequest->statusCheck() }}</span>
                                            @elseif ($leaveRequest->status == 2)
                                                <span class="btn btn-danger">{{ $leaveRequest->statusCheck() }}</span>
                                            @else
                                                <span class="btn btn-secondary">{{ $leaveRequest->statusCheck() }}</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Add button -->

                                                <form method="GET" action="{{route('employer.uploads.create')}}">
                
                                                    <button name="managefile" type="submit" value="{{$employee->id}}" class="mr-3"><span class="btn btn-success">ADD</span></button>

                                                </form>

                                                <form method="GET" action="{{route('employer.uploads.edit', $employee->id)}}">
                
                                                    <button name="managefile" type="submit" value=""><span class="btn btn-warning">UPDATE</span></button>

                                                </form>

                                                <!-- Add ends -->

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
