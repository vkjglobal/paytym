@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Rosters</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Employee</th>
                                    <th>Project</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rosters as $roster)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $roster->user->first_name." ".$roster->user->last_name}}</td>
                                        <td>{{ $roster->project->name }}</td>
                                        <td>{{ $roster->start_time}}</td>
                                        <td>{{ $roster->end_time}}</td>
                                        <td>{{ $roster->start_date}}</td>
                                        <td>{{ $roster->end_date}}</td>

                                        @if($roster->status == 0)
                                        <td>
                                            <a href="#" class='btn btn-secondary'>
                                            &nbsp   Not Started &nbsp &nbsp
                                            </a>
                                        </td>
                                        @elseif($roster->status == 1)
                                        <td>
                                            <a href="#" class='btn btn-success'>
                                            &nbsp &nbsp &nbsp  Started &nbsp &nbsp &nbsp &nbsp
                                            </a>
                                        </td>
                                        @else
                                        <td>
                                            <a href="#" class='btn btn-danger'>
                                                Not Completed &nbsp
                                            </a>
                                        </td>
                                        @endif
                                        
                                       
                                        
                                        <!-- <td>
                                            <input data-id="{{ $roster->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $roster->status ? 'checked' : '' }}>
                                        </td> -->
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                <a href="{{ route('employer.roster.edit', $roster->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $roster->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $roster->id }}"
                                                    action="{{ route('employer.roster.destroy', $roster->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

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
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var department_id = $(this).data('id');
                console.log(department_id);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('employer.department.change.status') }}',
                    data: {
                        'status': status,
                        'department_id': department_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script> -->
@endpush