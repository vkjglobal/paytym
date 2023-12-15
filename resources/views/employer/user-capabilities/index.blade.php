@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">User Capabilities</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Sl #</th>
                                <th>User Role</th>
                                <th>View & Edit Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usercapability as $usercapability)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <th>{{ optional(optional($usercapability)->role)->role_name}}</th>
                                <td> <!-- Edit button -->
                                        <a href="{{ route('employer.usercapabilities.edit', $usercapability->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                           View & Edit
                                        </a></td>

                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                       
                                        &nbsp;&nbsp;&nbsp;
                                        <!-- Delete button -->
                                        <button type="button" class="text-danger" onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $usercapability->id }}').submit();}" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i data-feather="trash"></i>
                                        </button>
                                        <form id="delete-data-{{ $usercapability->id }}" action="{{ route('employer.usercapabilities.destroy', $usercapability->id) }}" method="POST">
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
<!--  <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var benefit_id = $(this).data('id');
                
                console.log(cms_id);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('employer.benefit.change.status') }}',
                    data: {
                        'status': status,
                        'benefit_id': benefit_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script> -->
@endpush