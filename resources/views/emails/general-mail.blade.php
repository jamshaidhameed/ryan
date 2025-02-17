<x-mail::message>
    # {{ $mail_subject }}  

    Beste {{ $receiver }},  

    {{ $mail_message }}  

    Heeft u vragen of heeft u verdere assistentie nodig? Neem dan gerust contact met ons op.  

    Met vriendelijke groet,  
    **{{ env('Business_Title') }}**
</x-mail::message>
