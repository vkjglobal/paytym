@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

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
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Base salary</th>
                                    <th>Net salary</th>
                                    <th>Gross salary</th>
                                    <th>Paid salary</th>
                                    <th>Total tax</th>
                                    <th>Total Deduction</th>
                                    <th>Total allowance</th>
                                    <th>Total bonus</th>
                                    <th>Total commission</th>
                                    <th>Total FNPF</th>
                                    <th>Status</th>
                                    <th>Payslip</th>
                                    {{-- <td>Actions</td> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payrolls as $payroll)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($payroll->user)->first_name ?? 'Not added' }}</td>
                                        <td>{{ $payroll->start_date }}</td>
                                        <td>{{ $payroll->end_date }}</td>
                                        <td>{{ $payroll->base_salary }}</td>
                                        <td>{{ $payroll->net_salary }}</td>
                                        <td>{{ $payroll->gross_salary }}</td>
                                        <td>{{ $payroll->paid_salary }}</td>
                                        <td>{{ $payroll->total_tax }}</td>
                                        <td>{{ $payroll->total_deduction }}</td>
                                        <td>{{ $payroll->total_allowance }}</td>
                                        <td>{{ $payroll->total_bonus }}</td>
                                        <td>{{ $payroll->total_commission }}</td>
                                        <td>{{ $payroll->total_fnpf }}</td>
                                        <td>
                                            @if($payroll->salary - $payroll->total_deduction == $payroll->paid_salary)
                                                <a href="#" class="btn btn-success">Completed</a>
                                            @else
                                                <a href="#" class="btn btn-danger">Pending</a>   
                                            @endif
                                        </td>
                                        <td>
                                            <form method="GET" action="{{route('employer.payroll.show', $payroll->id)}}">
                                                <button name="approve" type="submit" value="">
                                                    <i data-feather="eye" class="text-info"></i>
                                                </button>
                                            </form>
                                        </td>
                                        {{-- <td>
                                            <form method="GET" action="{{route('employer.attendance.edit', $payroll->id)}}">
                                                <button name="approve" type="submit" value="">
                                                    <i data-feather="edit" class="text-warning"></i>
                                                </button>
                                            </form>
                                        </td> --}}

                                        {{-- <td>@isset($employee->employer->company) {{ $employee->employer->company }}@endisset</td> --}}

                                        
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
