@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Deductions for {{$employees->first_name}}</h6>
                    
                    <div class="float-right mb-3">
                        {{-- <button type="button" class="btn btn-outline-primary btn-icon-text">
                            <i class="btn-icon-prepend" data-feather="printer"></i>
                            Print
                          </button> --}}
                          {{-- <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.report.allowance.export")}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                          </button>  --}}
                    
                    </div>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                 
                                        <th>Deduction name</th>
                                        <th>Amount</th>



                            </thead>
                            <tbody>
                                @foreach($assign_deductions as $assign)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                                <td>@isset($assign->deduction->name)
                                                    {{ $assign->deduction->name }}
                                                @endisset</td>
                                                <td>{{$assign->rate}}</td>

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
