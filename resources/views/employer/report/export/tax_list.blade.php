@php
use Illuminate\Support\Carbon;
@endphp
<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Name</th>
                <th>Year</th>
                {{-- <th>Start date</th>
                <th>End date</th> --}}
                <th>Total tax withheld</th>

            </tr>
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
                        {{ Carbon::now()->year }}
                    </td>
                    {{-- <td>{{ optional($employee->payroll()->latest()->first())->start_date ?? 'No data' }}</td>
                    <td>{{ optional($employee->payroll()->latest()->first())->end_date ?? 'No data' }}</td> --}}
                    <td>
                        {{ optional($employee)->total_tax() ?? 'No data' }}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
