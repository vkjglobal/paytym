<table>
    <thead>
    <tr>
        <th>Sl #</th>
        <th>Name</th>
        <th>Buisness</th>
        <th>Branch</th>
        <th>Department</th>
        <th>Employment start date</th>
        <th>Employment end date</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>@isset($employee->first_name)
                    {{ $employee->first_name }}
                @endisset</td>
                <td>@isset($employee->business->name)
                    {{ $employee->business->name }}
                @endisset</td>
                <td>@isset($employee->branch->name)
                    {{ $employee->branch->name }}
                @endisset</td>
                <td>@isset($employee->department->dep_name)
                    {{ $employee->department->dep_name }}
                @endisset</td>
                <td>@isset($employee->employment_start_date)
                    {{ $employee->employment_start_date }}
                @endisset</td>
                <td>@isset($employee->employment_end_date)
                    {{ $employee->employment_end_date }}
                @endisset</td>

            </tr>
        @endforeach
    </tbody>
</table>