<x-mail::message>

Dear {{ $employee->first_name }},

Yours login credentials is as follows: <br>
email : {{$employee->email}}<br>
password: {{$password}}<br>
Please use the following link for downloading the application: <br>
    Playstore link

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
