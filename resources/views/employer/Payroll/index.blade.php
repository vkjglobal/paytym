@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Payroll</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Salary</th>
                                    <th>Payed Salary</th>
                                    <th>Fund deduction</th>
                                    <th>P tax</th>
                                    <th>total deduction</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payrolls as $payroll)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@isset($payroll->user->first_name) {{ $payroll->user->first_name }}@endisset</td>
                                        <td>{{ $payroll->salary }}</td>
                                        <td>{{ $payroll->paid_salary }}</td>
                                        <td>{{ $payroll->fund_deduction }}</td>
                                        <td>{{ $payroll->p_tax }}</td>
                                        <td>{{ $payroll->total_deduction }}</td>

                                        {{-- <td>@isset($employee->employer->company) {{ $employee->employer->company }}@endisset</td> --}}

                                        <td>
                                            @if($payroll->salary - $payroll->total_deduction == $payroll->paid_salary)
                                                <a href="#" class="btn btn-success">Completed</a>
                                            @else
                                                <a href="#" class="btn btn-danger">Pending</a>   
                                            @endif
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
