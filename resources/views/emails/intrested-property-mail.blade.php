<x-mail::message>
    # Een Nieuwe Woning die bij uw Interesse Past is Nu Beschikbaar op RyanRent!  

    We hebben zojuist een nieuwe woning toegevoegd die aansluit bij uw voorkeuren.  

    ## **Woningdetails**  
    - **Titel:** {{$property->title_en}}  
    - **Prijs:** €{{ number_format($property->price, 2) }}  

    Bezoek ons platform om deze woning te bekijken en uw ideale match te vinden.  

    Met vriendelijke groet,  
    **{{ env('Business_Title') }}**
</x-mail::message>
