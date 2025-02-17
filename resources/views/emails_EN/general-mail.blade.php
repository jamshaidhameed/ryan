<x-mail::message>
    # {{ $mail_subject }}

    Dear {{ $receiver }},  

    {{ $mail_message }}  

    If you have any questions or need further assistance, please feel free to reach out.  

    Best regards,  
    **{{ env('Business_Title') }}**
</x-mail::message>
