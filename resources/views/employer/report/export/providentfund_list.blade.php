<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Name</th>
                <th>Country PF</th>
                <th>Extra PF by Company</th>
                <th>Extra PF by Employer</th>
                <th>PF Start Date</th>
                <th>PF End Date</th>
                <th>Total PF</th>

        
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ optional($employee)->first_name ?? 'No data' }}
                        {{ optional($employee)->last_name ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($employee->country)->fnpf ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($employee->providentfund)->employer_rate ?? 'No data' }}
                    </td>
                    <td>{{ optional($employee->providentfund)->user_rate ?? 'No data' }}</td>
                    <td>{{ optional($employee->payroll()->latest()->first())->start_date ?? 'No data' }}</td>
                    <td>{{ optional($employee->payroll()->latest()->first())->end_date ?? 'No data' }}</td>
                    <td>{{ optional($employee->payroll()->latest()->first())->total_fnpf ?? 'No data' }}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
</div>
