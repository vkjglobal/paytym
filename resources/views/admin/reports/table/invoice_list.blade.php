<table id="dataTableExample" class="table">
    <thead>
        <tr>
            <th>Sl #</th>
            <th>Employer Name</th>
            <th>Company Name</th>
            <th>Plan</th>
            <th>Date</th>
            <th>Active Employess</th>
            <th>Amount</th>
            <th>Status</th>
            {{-- <th>Actions</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ optional($invoice->employer)->name ?? 'No data' }}</td>
                <td>{{ optional($invoice->employer)->company ?? 'No data' }}</td>
                <td>{{ is_null($invoice->custom_plan_id) ? optional($invoice->plan)->plan ?? 'No data' : optional($invoice->custom_plan)->plan ?? 'No data' }}</td>
                <td>{{ isset($invoice) && isset($invoice->date) ? date('M-Y', strtotime($invoice->date)) : 'No data' }}</td>
                <td>{{ optional($invoice)->active_employees ?? 'No data' }}</td>
                <td>{{ optional($invoice)->amount ?? 'No data' }}</td>
               {{-- <td>{{ optional($invoice)->status == '0' ? 'Pending' : 'Paid' }}</td>
                <td>{{ optional($invoice)->status == '0' ? 'Pending' : (optional($invoice)->status == '1' ? 'Paid' : 'Overdue') }}</td>
                <td class="status_{{$invoice->id}}">
                                            @if ($invoice->status == 2)
                                                <span class="btn btn-danger">Overdue</span>
                                            @elseif ($invoice->status == 0)
                                                <span class="btn btn-secondary">Pending</span>
                                            @else
                                                <span class="btn btn-success">Paid</span>
                                            @endif
                                        </td>--}}
                                        <td><span class="btn btn-{{ optional($invoice)->status == '0' ? 'secondary' :  (optional($invoice)->status == '1' ? 'success' : 'danger') }}">{{ optional($invoice)->status == '0' ? 'Pending' : (optional($invoice)->status == '1' ? 'Paid' : 'Overdue') }}</span></td>
            </tr>

        @endforeach
    </tbody>
</table>