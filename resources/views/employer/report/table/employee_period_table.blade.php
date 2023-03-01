<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Name</th>
                <th>Buisness</th>
                <th>Branch</th>
                <th>Department</th>
                <th>Employment start date</th>
                <th>Employment end date</th>

                {{-- <th>Check-in time</th>
                <th>Check-out time</th>
                <th>Status</th>
            </tr> --}}
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
                    

                    {{-- <td>{{ $employee->attendanceReport($attendances) }}</td> --}}
                    {{-- <td>{{ $employee->attendance->attendanceReport($employee->id, $date_from, $date_to) }}</td> --}}
                    {{-- <td>@isset($attendance->check_in)
                        {{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i:s') }}
                    @endisset</td>
                    <td>@if($attendance->check_out)
                        {{ \Carbon\Carbon::parse($attendance->check_out)->format('H:i:s') }}
                        @else
                        <span class="text-center">{{'-'}}</span>
                    @endif</td>
                    <td>{{ $attendance->status }}</td> --}}

                </tr>
            @endforeach
        </tbody>
    </table>
</div>