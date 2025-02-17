<!DOCTYPE html>
<html>

<head>
    <title>Huurovereenkomst</title>
</head>

<body>
    <h1>Huurovereenkomst per Maand</h1>

    <p><strong>Datum:</strong> {{ $todays_date }}</p>

    <p>
        Deze overeenkomst is gesloten tussen **{{$property_owner}}** (de "Eigenaar") en **{{$company_name}}** (het "Bedrijf")  
        voor de verhuur van de woning gelegen aan **{{$property->street_address}}** (de "Woning").
    </p>

    <p>
        Het Bedrijf stemt ermee in de Woning te huren op een **maand-tot-maand basis** voor een huurbedrag van **{{$property_price}} per maand**,  
        te betalen op de **1e dag van elke kalendermaand**.
    </p>

    <pre>
        ____________________________________________ <br>
                    Handtekening Eigenaar
    </pre>
</body>

</html>
