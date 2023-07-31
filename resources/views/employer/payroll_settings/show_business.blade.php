@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Payroll - Hourly</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Overtime rate</th>
                                    <th>Double time rate</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($businesses as $business)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $business->name}}</td>
                                        <td> {{ optional($business->payrollsetting)->over_time_rate ?? 'Not added' }}</td>
                                        <td> {{ optional($business->payrollsetting)->double_time_rate ?? 'Not added' }}</td>
                                        

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Add button -->



                                                <form method="GET" action ="{{route('employer.payroll-setting-hourly.create',$business->id)}}">
                
                                                    <button  type="submit"  class="mr-3"><span class="btn btn-success">MANAGE</span></button>

                                                </form>



                                                <!-- Add ends -->

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
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
@endpush
