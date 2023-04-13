<table id="dataTableExample" class="table">
    <thead>
        <tr>
            <th>Sl #</th>
            <th>Name</th>
             
            <th>Total Allowance Amount</th>
            

    </thead>
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>@isset($employee->first_name)
                    {{ $employee->first_name }}
                @endisset</td>
                <td>
                    {{ $employee->total_allowance() }}
                </td>
                
            </tr>
        @endforeach
    </tbody>
</table>