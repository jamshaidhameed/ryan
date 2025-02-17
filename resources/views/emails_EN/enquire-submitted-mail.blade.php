<x-mail::message>
    # Inquiry Received – Thank You!  

    Dear {{$enquire->first_name." ".$enquire->last_name}},  

    Thank you for reaching out to us. We have received your inquiry and our team is currently reviewing it.  

    We appreciate your interest in our services and will get back to you as soon as possible. If you need urgent assistance, please feel free to contact us directly.  

    We look forward to assisting you soon.  

    Best regards,  
    **{{ env('Business_Title') }}**
</x-mail::message>
