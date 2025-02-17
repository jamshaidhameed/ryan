<x-mail::message>
    # Nieuwe Woning Toegevoegd  

    Beste Beheerders,  

    Dhr. {{$owner}} heeft onlangs een nieuwe woning toegevoegd aan het systeem.  

    ## **Woningdetails**  
    - **Titel:** {{$property->title_en}}  
    - **Prijs:** {{$property->price}}  
    - **Adres:** {{$property->street_address}}  

    Gelieve de vermelding te bekijken en eventuele noodzakelijke acties te ondernemen.  

    Met vriendelijke groet,  
    **{{ env('Business_Title') }}**
</x-mail::message>
