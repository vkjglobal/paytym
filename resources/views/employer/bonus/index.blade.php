@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Bonus</h6>
                    <div class="table-responsive">
                        <button class="btn btn-success">ADD Bonus</button>
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Employer</th>
                                    <th>Type</th>
                                    <th>Type name</th>
                                    <th>Rate type</th>
                                    <th>Rate</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bonuses as $bonus)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bonus->employer->name }}</td>
                                        
                                        @if($bonus->type == 0)
                                            <td>{{ 'Employee' }}</td>
                                        @elseif($bonus->type == 1)
                                            <td>{{ 'Department' }}</td>
                                        @elseif($bonus->type == 2)
                                            <td>{{ 'Branch' }}</td>
                                        @else
                                            <td>{{ 'Business' }}</td>
                                        @endif

                                        @if($bonus->type == 0)
                                            <td>{{ $bonus->employer->name }}</td>
                                        @elseif($bonus->type == 1)
                                            <td>{{ $bonus->department->dep_name }}</td>
                                        @elseif($bonus->type == 2)
                                            <td>{{ $bonus->branch->name }}</td>
                                        @else
                                            <td>{{ $bonus->business->name }}</td>
                                        @endif

                                        @if($bonus->rate_type == 0)
                                            <td>{{ 'Percentage' }}</td>
                                        @else
                                            <td>{{ 'Fixed' }}</td>
                                        @endif

                                        <td>{{ $bonus->rate }}</td>
                                        {{-- <td>
                                            <input data-id="{{ $bonus->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $bonus->status ? 'checked' : '' }}>
                                        </td> --}}
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                 <a href="{{ route('employer.bonus.edit', $bonus->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $bonus->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $bonus->id }}"
                                                    action="{{ route('employer.bonus.destroy', $bonus->id) }}"
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
    {{-- <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var branch_id = $(this).data('id');
                console.log(branch_id);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('employer.branch.change.status') }}',
                    data: {
                        'status': status,
                        'branch_id': branch_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script> --}}
@endpush
