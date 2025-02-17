<x-mail::message>
    # Aanvraag Ontvangen – Bedankt!  

    Beste {{$enquire->first_name." ".$enquire->last_name}},  

    Bedankt voor uw bericht. Wij hebben uw aanvraag ontvangen en ons team is deze momenteel aan het beoordelen.  

    Wij waarderen uw interesse in onze diensten en zullen zo snel mogelijk contact met u opnemen. Heeft u dringend hulp nodig? Neem dan gerust direct contact met ons op.  

    We kijken ernaar uit om u binnenkort van dienst te zijn.  

    Met vriendelijke groet,  
    **{{ env('Business_Title') }}**
</x-mail::message>
