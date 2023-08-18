<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Name</th>
                <th>Business</th>
                <th>Base Salary</th>
                <th>Net Salary</th>
                <th>Gross Salary</th>
                <th>Paid Salary</th>

                <th>Total Tax</th>
                <th>Total Deduction</th>
                <th>Total Allowance</th>
                <th>Total Bonus</th>
                <th>Total Commission</th>
                <th>Start Date</th>
                <th>End Date</th>

                <th>Status</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($payrolls as $payroll)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@isset($payroll->user->first_name)
                        {{ $payroll->user->first_name }}
                    @endisset</td>
                    <td>@isset($payroll->user->business->name)
                        {{ $payroll->user->business->name }}
                    @endisset</td>
                    <td>@isset($payroll->base_salary)
                        {{ $payroll->base_salary }}
                    @endisset</td>
                    <td>@isset($payroll->net_salary)
                        {{ $payroll->net_salary }}
                    @endisset</td>
                    <td>@isset($payroll->gross_salary)
                        {{ $payroll->gross_salary }}
                    @endisset</td>
                    <td>@isset($payroll->paid_salary)
                        {{ $payroll->paid_salary }}
                    @endisset</td>
                    <td>@isset($payroll->total_tax)
                        {{ $payroll->total_tax }}
                    @endisset</td>
                    <td>@isset($payroll->total_deduction)
                        {{ $payroll->total_deduction }}
                    @endisset</td>
                    <td>@isset($payroll->total_allowance)
                        {{ $payroll->total_allowance }}
                    @endisset</td>
                    <td>@isset($payroll->total_bonus)
                        {{ $payroll->total_bonus }}
                    @endisset</td>
                    <td>@isset($payroll->total_commission)
                        {{ $payroll->total_commission }}
                    @endisset</td>
                    <td>@isset($payroll->start_date)
                        {{ $payroll->start_date }}
                    @endisset</td>
                    <td>@isset($payroll->end_date)
                        {{ $payroll->end_date }}
                    @endisset</td>
                    <td>@if($payroll->status == 0)
                            <span class="text-danger">Pending</span>
                        @else
                            <span class="text-success">Completed</span>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>