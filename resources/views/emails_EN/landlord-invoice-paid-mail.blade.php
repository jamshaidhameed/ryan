<x-mail::message>
    # Payment Confirmation – Invoice Paid  

    Dear {{$owner_name}},  

    We are pleased to inform you that the invoice for your property, **{{$property_name}}**, has been successfully paid for the month of **{{$invoice_month}}**.  

    ## **Payment Details**  
    - **Amount Paid:** €{{ number_format($invoice_amount, 2) }}  

    If you have any questions or require further details, please feel free to contact us.  

    Best regards,  
    **{{ env('Business_Title') }}**
</x-mail::message>
