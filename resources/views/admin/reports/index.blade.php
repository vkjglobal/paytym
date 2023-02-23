@extends('admin.layouts.app')
@section('content')
    {{-- @component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <h6 class="card-title">Report</h6>
                    <div class="float-right mb-3">
                        <button type="button" class="btn btn-outline-primary btn-icon-text">
                            <i class="btn-icon-prepend" data-feather="printer"></i>
                            Print
                          </button>
                          <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("admin.main_report.download")}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                          </button> 
                    
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Company</th>
                                    <th>City/Town</th>
                                    <th>Active Employees</th>
                                    <th>Inctive Employees</th>
                                    <th>View</th>
                                    {{-- <th>FNPF</th>
                                    <th>Status</th>
                                    <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $company->company }}</td>
                                        <td>{{ $company->city }}</td>
                                        <td>{{ $company->get_active_employees() }}</td>
                                        <td>{{ $company->get_inactive_employees() }}</td>
                                        <td>
                                            <!-- Edit button -->
                                            <a href=""
                                                class="mr-1 text-info" data-toggle="tooltip" data-placement="top"
                                                title="Edit">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </td>
                                        {{-- <td>{{ $country->fnpf }}</td> --}}
                                        {{-- <td>
                                            <input data-id="{{ $country->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $country->status ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <!-- Edit button -->
                                                <a href="{{ route('admin.country.edit', $country->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $country->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $country->id }}"
                                                    action="{{ route('admin.country.destroy', $country->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td> --}}
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
  
@endpush
