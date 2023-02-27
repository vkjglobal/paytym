<x-mail::message>

The Employement period for {{$employee->first_name.' '.$employee->last_name}} is ending tomorrow - {{$date}}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
