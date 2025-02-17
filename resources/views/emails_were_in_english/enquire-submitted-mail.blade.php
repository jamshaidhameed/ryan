<x-mail::message>
    # Enquire submitted
    Dear {{$enquire->first_name." ".$enquire->last_name}},

    Thank you for submitting your inquiry to our team. We have received your message and will be reviewing it shortly.
    We appreciate your interest in our services and will do our best to respond as soon as possible.
    Thank you again for reaching out to us, and we look forward to speaking with you soon.
    
    Best regards,
    Thanks,
    {{ env('Business_Title') }}
</x-mail::message>
