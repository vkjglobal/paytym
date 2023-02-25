<table id="dataTableExample" class="table">
    <thead>
        <tr>
            <th>Sl #</th>
            <th>Name</th>
            <th>Buisness</th>
            <th>City/town</th>
            <th>Country</th>
            <th>Post code</th>
            <th>Bank</th>
            <th>Account Number</th>
            <th>Status</th>
    </thead>
    <tbody>
        @foreach ($branches as $branch)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $branch->name }}
                </td>
                <td>
                    @isset($branch->business->name)
                        {{ $branch->business->name }}
                    @endisset   
                    </td>
                <td>
                    {{ $branch->city }}
                </td>
                <td>
                    {{ $branch->country }}
                </td>
                <td>
                    {{ $branch->postcode }}
                </td>
                <td>
                    {{ $branch->bank }}
                </td>
                <td>
                    {{ $branch->account_number }}
                </td>
                <td>@if($branch->status == 0)
                        <span class="btn btn-danger">Inactive</span>
                    @else
                        <span class="btn btn-success">Active</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>