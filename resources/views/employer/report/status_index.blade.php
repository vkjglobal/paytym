@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Status Reports</h6>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ '1' }}</td>
                                    <th class="text-primary "><a href="{{route('employer.report.status.business')}}">{{ 'Business' }}</a></th>
                                </tr>
                                <tr>
                                    <td>{{ '2' }}</td>
                                    <th class="text-primary"><a href="{{route('employer.report.status.branch')}}">{{ 'Branch' }}</a></th>
                                </tr>
                                <tr>
                                    <td>{{ '3' }}</td>
                                    <th class="text-primary"><a href="{{route('employer.report.status.department')}}">{{ 'Department' }}</a></th>
                                </tr>
                                <tr>
                                    <td>{{ '4' }}</td>
                                    <th class="text-primary"><a href="{{route('employer.report.status.project')}}">{{ 'Projects' }}</a></th>
                                </tr>
                                
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
