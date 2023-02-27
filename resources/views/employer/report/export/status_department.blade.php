<table id="dataTableExample" class="table">
    <thead>
        <tr>
            <th>Sl #</th>
            <th>Name</th>
            <th>Branch</th>
            <th>Business</th>
            <th>Status</th>
    </thead>
    <tbody>
        @foreach ($departments as $department)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $department->dep_name }}
                </td>
                <td>
                @isset($department->branch->name)
                    {{ $department->branch->name }}
                @endisset 
                </td>
                <td>
                    @isset($department->branch->business->name)
                        {{ $department->branch->business->name }}
                    @endisset 
                    </td>
                <td>@if($department->status == 0)
                        <span class="btn btn-danger">Inactive</span>
                    @else
                        <span class="btn btn-success">Active</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>