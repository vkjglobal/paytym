<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Employer Name</th>
                <th>Plan</th>
                <th>Date</th>
                <th>Active Employess</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ optional($invoice->employer)->name ?? 'No data' }}</td>
                    <td>{{ is_null($invoice->custom_plan_id) ? optional($invoice->plan)->plan ?? 'No data' : optional($invoice->custom_plan)->plan ?? 'No data' }}</td>
                    <td>{{ isset($invoice) && isset($invoice->date) ? date('M-Y', strtotime($invoice->date)) : 'No data' }}</td>
                    <td>{{ optional($invoice)->active_employees ?? 'No data' }}</td>
                    <td>{{ optional($invoice)->amount ?? 'No data' }}</td>
                    <td>{{ optional($invoice)->status == '0' ? 'Pending' : 'Paid' }}</td>

                </tr>

            @endforeach
        </tbody>
    </table>
</div>