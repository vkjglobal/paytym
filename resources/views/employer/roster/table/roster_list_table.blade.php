    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Employee</th>
                <th>Business</th>
                <th>Branch</th>
                <th>Department</th>
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
                    <td>{{ optional($roster->branch)->name ?? 'no data'}}</td> 
                    <td>{{ optional($roster->department)->dep_name ?? 'no data'}}</td> 
                    <td>{{ $roster->start_date}}</td>
                    <td>{{ $roster->end_date}}</td>

                    @if($roster->status == 0)
                    <td>
                        <a href="#" class='btn btn-secondary'>
                           Not Started &nbsp &nbsp
                        </a>
                    </td>
                    @elseif($roster->status == 1)
                    <td>
                        <a href="#" class='btn btn-success'>
                          Started 
                        </a>
                    </td>
                    @else
                    <td>
                        <a href="#" class='btn btn-danger'>
                            Not Completed &nbsp
                        </a>
                    </td>
                    @endif
                    
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">

                            <!-- Edit button -->
                            <!-- <a href="{{ route('employer.roster.edit', $roster->id) }}"
                                class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                title="Edit">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </a> -->

                            <!-- Delete button -->
                            <button type="button" class="text-danger"
                                onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                    document.getElementById('delete-data-{{ $roster->id }}').submit();}"
                                data-toggle="tooltip" data-placement="top" title="Delete">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
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