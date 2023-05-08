<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Name</th>
                <th>Start date</th>
                <th>End Date</th>
                <th>Status</th>


        </thead>
        <tbody>
            @foreach ($payrolls as $payroll)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ optional($payroll->user)->first_name ?? 'No data' }}
                        {{ optional($payroll->user)->last_name ?? 'No data' }}
                    </td>
                    <td>{{ optional($payroll)->start_date ?? 'No data' }}</td>
                    <td>{{ optional($payroll)->end_date ?? 'No data' }}</td>
                    <td>
                        {{ optional($payroll)->status == '0' ? 'Pending' : 'Completed' ?? 'no data' }}
                    </td>




                </tr>
            @endforeach
        </tbody>
    </table>
</div>
