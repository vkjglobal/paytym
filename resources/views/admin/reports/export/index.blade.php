<table id="dataTableExample" class="table">
    <thead>
        <tr>
            <th>Sl #</th>
            <th>Company</th>
            <th>Name</th>
            <th>Email</th>
            <th>Company phone</th>
            <th>City/Town</th>
            <th>Active Employees</th>
            <th>Inctive Employees</th>
            {{-- <th>View</th> --}}
            {{-- <th>FNPF</th>
            <th>Status</th>
            <th>Actions</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($companies as $company)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $company->company }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->company_phone  }}</td>
                <td>{{ $company->city }}</td>
                <td>{{ $company->get_active_employees() }}</td>
                <td>{{ $company->get_inactive_employees() }}</td>
               
            </tr>
        @endforeach
    </tbody>