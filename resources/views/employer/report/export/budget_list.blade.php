<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Year</th>
                <th>Budget</th>
                <th>Total sent</th>

        </thead>
        <tbody>
            @foreach ($budgets as $budget)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ optional($budget)->year ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($budget)->budget_amount ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($budget)->total_budget() ?? 'No data' }}
                    </td>


             </tr>
            @endforeach
        </tbody>
    </table>
</div>
