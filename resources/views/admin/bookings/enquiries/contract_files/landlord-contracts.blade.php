<!DOCTYPE html>
<html>

<head>
    <title>Contract</title>
</head>

<body>
    <h1>Rental Agreement Month-to-Month</h1>
    <p>Date {{ $todays_date }}</p>
    <p>Agreement between, {{$property_owner}}, Owner's and {{$company_name}} for the dwelling located at
        {{$property->street_address}} (Location).
    </p>
    <p>
        Company agree to rent this dwelling the property in month-to-moth basis for {{$property_price}} per month payable on the 1st day of
        calendar month.
    </p>

    <pre>
        ____________________________________________ <br>
                    Owner signature
    </pre>
</body>

</html>