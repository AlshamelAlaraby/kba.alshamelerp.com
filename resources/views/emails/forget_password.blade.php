@component('mail::message')
# Forget Password

Use the following code to reset your password:
@component('mail::panel')
{{ $code }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
