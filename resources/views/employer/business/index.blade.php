@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Businesses</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <!-- <th>Description</th> -->
                                    <th>QR Code</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($businesses as $business)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $business->name }}</td>
                                        <!-- <td>{{ $business->description }}</td> -->
                                        <td><a href="{{ route('employer.business.view_qrcode', $business->id) }}"  class="btn btn-primary" >View QR Code</a></td> 
                                        <td>
                                            <input data-id="{{ $business->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $business->status ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                 <a href="{{ route('employer.business.edit', $business->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $business->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $business->id }}"
                                                    action="{{ route('employer.business.destroy', $business->id) }}"
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

    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var business_id = $(this).data('id');
                console.log(business_id);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('employer.business.change.status') }}',
                    data: {
                        'status': status,
                        'business_id': business_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
  
@endpush
