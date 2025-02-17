<x-mail::message>
    # Welkom bij {{ env('Business_Title') }} – Uw Account is Gereed!  

    Beste {{$user->first_name." ".$user->last_name"}},  

    Gefeliciteerd! Uw registratie is succesvol voltooid.  
    Uw account is nu actief en u kunt direct gebruik maken van ons platform.  

    ## **Uw Accountgegevens**  
    - **E-mail:** {{$user->email}}  
    - **Wachtwoord:** {{ $password }}  

    Om de veiligheid van uw account te garanderen, raden wij aan om uw wachtwoord te wijzigen na uw eerste login.  

    Heeft u zich niet geregistreerd voor dit account? Neem dan direct contact op met ons supportteam.  

    Met vriendelijke groet,  
    **{{ env('Business_Title') }}**
</x-mail::message>
