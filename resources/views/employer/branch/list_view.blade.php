@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Branches</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Sl #</th>
                                <th>Name</th>
                                <th>Business</th>
                                <!-- <th>Town/City</th>
                                    <th>Post Code</th>
                                    <th>Country</th>
                                    <th>Bank</th>
                                    <th>Account Number</th> -->
                                <th>QR Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $branch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $branch->name }}</td>
                                <td>{{ optional($branch->business)->name ?? 'no-data' }}</td>
                                <!-- <td>{{ $branch->city }}</td> -->
                                <!-- <td>{{ $branch->town }}</td>
                                        <td>{{ $branch->postcode }}</td>
                                        <td>{{ $branch->country }}</td>
                                        <td>{{ $branch->bank }}</td>
                                        <td>{{ $branch->account_number }}</td> 
                                <td>{{ $branch->account_number }}</td>
                                <td>{{ $branch->town }}</td>-->
                                <td><a href="{{ route('employer.branch.view_branch_qrcode', $branch->id) }}"  class="btn btn-primary" >View QR Code</a></td> 
                                <td>
                                    <input data-id="{{ $branch->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $branch->status ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <!-- Edit button -->
                                        <a href="{{ route('employer.branch.edit', $branch->id) }}" class="mr-1 text-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i data-feather="edit"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <button type="button" class="text-danger" onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $branch->id }}').submit();}" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i data-feather="trash"></i>
                                        </button>
                                        <form id="delete-data-{{ $branch->id }}" action="{{ route('employer.branch.destroy', $branch->id) }}" method="POST">
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
</script>
@endpush