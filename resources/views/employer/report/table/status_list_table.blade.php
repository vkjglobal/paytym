@php
    use Illuminate\Support\Carbon;
@endphp
<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Business name</th>
                <th>Branch name</th>
                <th>Department name</th>
                <th>Status</th>
                <th>Date</th>
                <th>No of active employees</th>
                <th>Leaves</th>
                {{-- <th>Download</th>
                <th>Email</th> --}}

        </thead>
        <tbody>
            @foreach ($statuses as $status)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ optional($status->branch->business)->name ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($status->branch)->name ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($status)->dep_name ?? 'No data' }}
                    </td>

                    <td>{{ optional($status)->status == '0' ? 'Inactive' : 'Active' }}</td>
                    <td>{{ Carbon::today()->format('D-M-Y') }}</td>
                    <td>{{ optional($status)->active_employee() ?? 'No data' }}</td>
                    <td>{{ optional($status->leavesCount()->where('status', '1')->where('start_date', Carbon::today()))->count() ?? 'No data' }}</td>
                    {{-- <td>
                        {{ optional($status)->status == '0' ? 'Pending' : 'Completed' ?? 'no data'  }}
                    </td> --}}



                </tr>
            @endforeach
        </tbody>
    </table>
</div>
