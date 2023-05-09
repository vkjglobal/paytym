<table id="dataTableExample" class="table">
    <thead>
        <tr>
            <th>Sl #</th>
            <th>Name</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Total Allowance Amount</th>
            <th>Total Bonus Amount</th>
            <th>Total Commission Amount</th>


    </thead>
    <tbody>
        @foreach ($payrolls as $payroll)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ optional($payroll->user)->first_name }} {{ optional($payroll->user)->last_name }}
                </td>
                <td>
                    {{ $payroll->start_date }}
                </td>
                <td>
                    {{ $payroll->end_date }}
                </td>
                <td>
                    {{ $payroll->total_allowance }}
                </td>
                <td>
                    {{ $payroll->total_bonus }}
                </td>
                <td>
                    {{ $payroll->total_commission }}
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
