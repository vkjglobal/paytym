<x-mail::message>
# Password Change

Please find the password

# {{ $rand_pass }}
{{--<p><a href="{{ route('verification.verify', ['id' => $employer->id, 'hash' => sha1($employer->email_verified_token)]) }}">Verify Email</a></p>--}}
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>