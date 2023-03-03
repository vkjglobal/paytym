@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Assigned Projects</h6>
                    <div class="table-responsive">
                    
                    <table id="dataTableExample" class="table">
                            
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Emploee</th>
                                    <th>Project</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assign_projects as $assign_project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@isset($assign_project->user->first_name,$assign_project->user->last_name )
                                            {{ $assign_project->user->first_name .' '. $assign_project->user->last_name }}
                                        @endisset</td>
                                        <td>@isset($assign_project->project->name)
                                            {{ $assign_project->project->name }}
                                        @endisset</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                <a href="{{ route('employer.assign.edit', $assign_project->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $assign_project->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $assign_project->id }}"
                                                    action="{{ route('employer.assign.destroy', $assign_project->id) }}"
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