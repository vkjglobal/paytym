<table id="dataTableExample" class="table">
    <thead>
        <tr>
            <th>Sl #</th>
            <th>Name</th>
            <th>Branch</th>
            <th>Department</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Description</th>
            <th>Status</th>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $project->name }}
                </td>
                <td>
                    @isset($project->branch->name)
                        {{ $project->branch->name }}
                    @endisset 
                </td>
                <td>
                    @isset($project->department->dep_name)
                        {{ $project->department->dep_name }}
                    @endisset 
                </td>
                <td>
                    {{ $project->start_date }}
                </td>
                <td>
                    {{ $project->end_date }}
                </td>
                <td>
                    {{ $project->description }}
                </td>
                <td>@if($project->status == 0)
                        <span class="btn btn-danger">Inactive</span>
                    @else
                        <span class="btn btn-success">Active</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>