<table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Hours worked</th>
                                    <th>Extra Hours</th>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    {{--<th>Status</th>--}}
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@isset($employee->first_name)   
                                            {{ $employee->first_name }}
                                        @endisset</td>
                                        <td>{{ $employee->attendanceReport($date_from, $date_to) }}</td>
                                        <td>{{ $employee->attendanceReport_extrahours($date_from, $date_to) }}</td>
                                        <td>@isset($date_from)
                                            {{ $date_from }} @else {{ $employee->employment_start_date }}
                                        @endisset</td>
                                        <td>@isset($date_to) 
                                            {{ $date_to }} @else {{ $today }}
                                        @endisset</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>