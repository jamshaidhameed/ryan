<x-mail::message>
    # Registratie Succesvol – Welkom bij {{ env('Business_Title') }}!  

    Beste {{$user->name}},  

    Wij zijn verheugd u te informeren dat uw registratie succesvol is voltooid.  
    Uw account is nu actief en u kunt direct gebruik maken van ons platform.  

    ## **Uw Accountgegevens**  
    - **E-mail:** {{$user->email}}  

    Mocht u vragen hebben of hulp nodig hebben, neem dan gerust contact op met ons supportteam.  

    Met vriendelijke groet,  
    **{{ env('Business_Title') }}**
</x-mail::message>
