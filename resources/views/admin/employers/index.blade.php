@extends('admin.layouts.app')
@section('content')
    @component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Employers</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Company</th>
                                    <th>Contact Person</th>
                                    <th>Reg Date</th>
                                    <th>Company Phone</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employers as $employer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employer->company }}</td>
                                        <td>{{ $employer->name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($employer->created_at)) }}</td>
                                        <td>{{ $employer->company_phone }}</td>
                                        <td>{{ $employer->email }}</td>
                                        <td>{{ $employer->country->name }}</td>
                                        <td>
                                        <button data-id="{{ $employer->id }}" class="status-btn btn {{ $employer->status ? 'btn-success' : 'btn-danger' }} btn-fixed-width">
                                            {{ $employer->status ? 'Active' : 'Inactive' }}
                                        </button>

                                </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                <a href="{{ route('admin.employers.edit', $employer->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $employer->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $employer->id }}"
                                                    action="{{ route('admin.employers.destroy', $employer->id) }}"
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
    $('.status-btn').click(function(event) {
        event.preventDefault(); // prevent default action

        var status = $(this).hasClass('btn-success') ? 0 : 1;
        var employer_id = $(this).data('id');

        var confirmed = confirm("Are you sure you want to change the status?");
        if (confirmed) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('admin.employer.change.status') }}',
                data: {
                    'status': status,
                    'employer_id': employer_id
                },
                success: function(data) {
                    console.log(data.success);
                    var newStatus = (status == 1) ? 'Active' : 'Inactive';
                    var newClass = (status == 1) ? 'btn-success' : 'btn-danger';
                    $(this).text(newStatus).removeClass('btn-success btn-danger').addClass(newClass);
                }.bind(this)
            });
        }
    });
});
</script>

@endpush
