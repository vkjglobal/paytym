<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Employee</th>
                <th>Business</th>
                <th>Department</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rosters as $roster)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@isset($roster->user->first_name) {{ $roster->user->first_name." ".$roster->user->last_name}} @endisset</td>
                    <td>{{ optional($roster->business)->name ?? 'no data'}}</td> 
                    <td>{{ optional($roster->department)->dep_name ?? 'no data'}}</td> 
                    <td>{{ $roster->start_time}}</td>
                    <td>{{ $roster->end_time}}</td>
                    <td>{{ $roster->start_date}}</td>
                    <td>{{ $roster->end_date}}</td>

                    @if($roster->status == 0)
                    <td>
                        <a href="#" class='btn btn-secondary'>
                        &nbsp   Not Started &nbsp &nbsp
                        </a>
                    </td>
                    @elseif($roster->status == 1)
                    <td>
                        <a href="#" class='btn btn-success'>
                        &nbsp &nbsp &nbsp  Started &nbsp &nbsp &nbsp &nbsp
                        </a>
                    </td>
                    @else
                    <td>
                        <a href="#" class='btn btn-danger'>
                            Not Completed &nbsp
                        </a>
                    </td>
                    @endif
                    
                    
                    
                    <!-- <td>
                        <input data-id="{{ $roster->id }}" class="toggle-class" type="checkbox"
                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                            data-on="Active" data-off="InActive"
                            {{ $roster->status ? 'checked' : '' }}>
                    </td> -->
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">

                            <!-- Edit button -->
                            <a href="{{ route('employer.roster.edit', $roster->id) }}"
                                class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                title="Edit">
                                <i data-feather="edit"></i>
                            </a>

                            <!-- Delete button -->
                            <button type="button" class="text-danger"
                                onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                    document.getElementById('delete-data-{{ $roster->id }}').submit();}"
                                data-toggle="tooltip" data-placement="top" title="Delete">
                                <i data-feather="trash"></i>
                            </button>
                            <form id="delete-data-{{ $roster->id }}"
                                action="{{ route('employer.roster.destroy', $roster->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>