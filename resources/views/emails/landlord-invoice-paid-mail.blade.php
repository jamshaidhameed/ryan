<x-mail::message>
    # Betalingsbevestiging – Factuur Betaald  

    Beste {{$owner_name}},  

    Wij informeren u graag dat de factuur voor uw woning, **{{$property_name}}**, succesvol is betaald voor de maand **{{$invoice_month}}**.  

    ## **Betalingsdetails**  
    - **Betaald Bedrag:** €{{ number_format($invoice_amount, 2) }}  

    Mocht u vragen hebben of verdere details nodig hebben, neem dan gerust contact met ons op.  

    Met vriendelijke groet,  
    **{{ env('Business_Title') }}**
</x-mail::message>
