<x-mail::message>

Dear {{ $employer->name }},

<br>
Yours login credentials for the Paytym Employer portal is as follows: <br>

email : {{$employer->email}}<br>
password: {{$password}}<br>

</x-mail::message>