<x-mail::message>

Dear {{ $employee->first_name }},

Business: {{optional($employee->business)->name ?? 'No data'}}<br>
Branch: {{optional($employee->branch)->name ?? 'No data'}}<br>
Department: {{optional($employee->department)->dep_name ?? 'No data'}}<br>
Position: {{optional($employee->role)->role_name ?? 'No data'}}<br>
Salary Type: {{isset($employee->salary_type) == 0 ? 'Fixed' : 'Hourly'}}<br>
Amount: {{optional($employee)->rate ?? 'No data'}}<br>
Employment Start Date: {{optional($employee)->employment_start_date ?? 'No data'}}<br>
<br>
Yours login credentials is as follows: <br>
email : {{$employee->email}}<br>
password: {{$password}}<br>
<!-- Please use the following link for downloading the application: <br>
    Playstore link -->

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
