@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Projects</h6>

                    <div class="float-right mb-3">
                            <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.report.projectreport.export")}}'">
                                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                                Download Report
                            </button> 
                        </div>
                    <div class="datalist-table table-responsive">
                    <div id="project_report_table">
                                @include('employer.report.table.projectbudget_list_table')
                            </div>
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
