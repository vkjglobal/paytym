<table>
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Employee</th>
                <th>Business</th>
                <th>Branch</th>
                <th>Department</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rosters as $roster)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@isset($roster->user->first_name) {{ $roster->user->first_name." ".$roster->user->last_name}} @endisset</td>
                    <td>@isset($roster->business->name){{$roster->business->name}} @endisset</td> 
                    <td>@isset($roster->branch->name){{ $roster->branch->name }} @endisset</td> 
                    <td>@isset($roster->department->dep_name){{ $roster->department->dep_name }} @endisset</td> 
                    <td>{{ $roster->start_time}}</td>
                    <td>{{ $roster->end_time}}</td>
                    <td>{{ $roster->start_date}}</td>
                    <td>{{ $roster->end_date}}</td>

                    @if($roster->status == 0)
                    <td>

                           Not Started 

                    </td>
                    @elseif($roster->status == 1)
                    <td>

                          Started 

                    </td>
                    @else
                    <td>

                            Not Completed 

                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>