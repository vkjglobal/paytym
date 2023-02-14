@extends('admin.layouts.app')
@section('content')
    @component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Subscriptions</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Plan</th>
                                    <th>Employee Range</th>
                                    <th>Rate Per Employee</th>
                                    <th>Rate Per Month</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscription as $subscription)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subscription->plan }}</td>
                                        <td>{{ $subscription->range_from }} - {{$subscription->range_to}}</td>
                                        <td>{{ $subscription->rate_per_employee }}</td>
                                        <td>@if (isset($subscription->rate_per_month ))
                                        {{ $subscription->rate_per_month }}
                                        @else
                                            -
                                        @endif</td>
                                        <td>
                                            <input data-id="{{ $subscription->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $subscription->status ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <!-- <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $subscription->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $subscription->id }}"
                                                    action="{{ route('admin.subscriptions.destroy', $subscription->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form> -->

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
                var subscription_id = $(this).data('id');
                console.log(subscription_id);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('admin.subscriptions.change.status') }}',
                    data: {
                        'status': status,
                        'subscription_id': subscription_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endpush
