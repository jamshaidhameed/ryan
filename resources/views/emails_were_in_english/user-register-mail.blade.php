<x-mail::message>
    # Registration Confirmation

    Dear {{$user->first_name." ".$user->last_name}}
    We are pleased to inform you that you have successfully registered for our system.
    Your account has been created and is now ready for use.

    Account: {{$user->email}}
    Password: {{ $password }}

    Best regards,
     {{ env('Business_Title') }}
</x-mail::message>