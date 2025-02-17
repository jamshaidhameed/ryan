<x-mail::message>
    # Welcome to {{ env('Business_Title') }} – Your Account is Ready!

    Dear {{$user->first_name." ".$user->last_name"}},

    Congratulations! Your registration has been successfully completed.  
    Your account is now active, and you can start using our platform immediately.

    ## **Your Account Details**  
    - **Email:** {{$user->email}}  
    - **Password:** {{ $password }}  

    To ensure the security of your account, we recommend updating your password after your first login.

    If you did not register for this account, please contact our support team immediately.

    Best regards,  
    **{{ env('Business_Title') }}**
</x-mail::message>
