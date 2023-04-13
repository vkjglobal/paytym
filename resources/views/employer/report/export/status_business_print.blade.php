<h1>Status Report - Business</h1>
<table id="dataTableExample" class="table">
    <thead>
        <tr>
            <th>Sl #</th>
            <th>Buisness</th>
            <th>Description</th>
            <th>Status</th>
    </thead>
    <tbody>
        @foreach ($business as $bus)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $bus->name }}
                </td>
                <td>
                    {{ $bus->description }}
                </td>
                <td>@if($bus->status == 0)
                        <span class="btn btn-danger">Inactive</span>
                    @else
                        <span class="btn btn-success">Active</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>