<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Login Credentials</title>
</head>

<body>
    <table style="width: 100%; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 18px;">
        <tr>
            <td>
                <table style="width: 500px; margin: 0 auto; border-collapse: collapse;">
                    <tr>
                        <th>
                            <img src="https://paytym.net/home_assets/images/logo.png" style="display: block; width: 100px;" alt="">
                        </th>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <h4>Dear {{ $employee->first_name }},</h4>

                            Business: {{optional($employee->business)->name ?? 'No data'}}<br>
                            Branch: {{optional($employee->branch)->name ?? 'No data'}}<br>
                            Department: {{optional($employee->department)->dep_name ?? 'No data'}}<br>
                            Position: {{optional($employee->role)->role_name ?? 'No data'}}<br>
                            Salary Type: {{isset($employee->salary_type) == 0 ? 'Fixed' : 'Hourly'}}<br>
                            Salary Period: {{ optional($employee)->pay_period == 0 ? 'Weekly' : (optional($employee)->pay_period == 1 ? 'Fortnightly' : (optional($employee)->pay_period == 2 ? 'Monthly' : 'Unknown')) }}<br>
                            Gross Pay: {{optional($employee)->rate ?? 'No data'}}<br>
                            Employment Start Date: {{optional($employee)->employment_start_date ?? 'No data'}}<br>
                            <br>
                            Yours login credentials is as follows: <br>
                            email : {{$employee->email}}<br>
                            password: {{$password}}<br>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            Email: <a href="mailto:contact@paytym.net" style="">contact@paytym.net</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>



{{--<x-mail::message>

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
</x-mail::message>--}}
