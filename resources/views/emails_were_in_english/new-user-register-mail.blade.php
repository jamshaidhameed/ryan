<x-mail::message>
    # Registration Confirmation

    Dear {{$user->name}}
    We are pleased to inform you that you have successfully registered for our system.
    Your account has been created and is now ready for use.

    Account: {{$user->email}}

    Best regards,
    {{ env('Business_Title') }}
</x-mail::message>