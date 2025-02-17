<x-mail::message>
    # Registration Successful – Welcome to {{ env('Business_Title') }}!

    Dear {{$user->name}},

    We are delighted to inform you that your registration has been successfully completed.  
    Your account is now active, and you can start using our platform immediately.

    ## **Your Account Details**  
    - **Email:** {{$user->email}}  

    If you have any questions or need assistance, feel free to reach out to our support team.  

    Best regards,  
    **{{ env('Business_Title') }}**
</x-mail::message>
