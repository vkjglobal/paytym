<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
            <tr>
                <th>Sl #</th>
                <th>Name</th>
                <th>Start date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>View</th>
                <th>Download</th>
                <th>Email</th>

        </thead>
        <tbody>
            @foreach ($payrolls as $payroll)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ optional($payroll->user)->first_name ?? 'No data' }}
                        {{ optional($payroll->user)->last_name ?? 'No data' }}
                    </td>
                    <td>{{ optional($payroll)->start_date ?? 'No data' }}</td>
                    <td>{{ optional($payroll)->end_date ?? 'No data' }}</td>
                    <td>
                        {{ optional($payroll)->status == '0' ? 'Pending' : 'Completed' ?? 'no data'  }}
                    </td>
                    <td>
                        <a href="{{$payroll->payslip_file_path()}}" target="_blank">View</a>
                    </td>
                    <td>
                        <a href="{{$payroll->payslip_file_path()}}" download="paslip_{{optional($payroll->user)->first_name ?? 'No data'}}.pdf">Download</a>
                    </td>
                    <td>
                        <form action="{{route('employer.report.payslip.send.mail')}}" method="post">
                            @csrf
                            <input type="hidden" name="email" value="{{optional($payroll->user)->email ?? 'No data'}}">
                            <input type="hidden" name="filename" value="{{$payroll->payslip_file_path()}}">
                            <input type="submit" value="Email">
                        </form>
                    </td>




                </tr>
            @endforeach
        </tbody>
    </table>
</div>
