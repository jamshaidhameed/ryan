<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Agreement - Residential Property</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            line-height: 1.6;
        }
        h1, h2, h3, h4, h5 {
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            background: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .signature {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Rental Agreement – Residential Property</h1>
    <p><strong>Model established by the Real Estate Council (ROZ) on March 20, 2017.</strong></p>
    <p>
        Reference to and use of this model are only permitted if any added, inserted, or deviating text is clearly recognizable as such.
        Additions and deviations should preferably be included under the heading "Special Provisions."
        The ROZ excludes any liability for negative consequences resulting from the use of this model text.
    </p>

    <h2>THE UNDERSIGNED:</h2>

    <h3>Landlord</h3>
    <table>
        <tr>
            <td><strong>Name</strong></td>
            <td>{{$company_name}}</td>
        </tr>
        <tr>
            <td><strong>Legally Represented by</strong></td>
            <td>Mrs. C. Stam</td>
        </tr>
        <tr>
            <td><strong>Address</strong></td>
            <td>Energieweg 22C, 3133 EC Vlaardingen</td>
        </tr>
        <tr>
            <td><strong>Phone Number</strong></td>
            <td>085 111 97 91</td>
        </tr>
        <tr>
            <td><strong>Email Address</strong></td>
            <td>Christa@ryanrent.nl</td>
        </tr>
    </table>

    <p><strong>Hereinafter referred to as "the Landlord"</strong></p>

    <p><strong>AND</strong></p>

    <h3>Tenant</h3>
    <table>
        <tr>
            <td><strong>Name</strong></td>
            <td>{{$tenant_name}}</td>
        </tr>
        <tr>
            <td><strong>Legally Represented by</strong></td>
            <td>Mrs. C. Stam</td>
        </tr>
        <tr>
            <td><strong>Address</strong></td>
            <td>Energieweg 22C, 3133 EC Vlaardingen</td>
        </tr>
        <tr>
            <td><strong>Phone Number</strong></td>
            <td>085 111 97 91</td>
        </tr>
        <tr>
            <td><strong>Email Address</strong></td>
            <td>Christa@ryanrent.nl</td>
        </tr>
        <tr>
            <td><strong>Email for Invoices</strong></td>
            <td>Christa@ryanrent.nl</td>
        </tr>
    </table>

    <p><strong>Hereinafter referred to as "the Tenant"</strong></p>

    <h2>CONSIDERING THAT:</h2>
    <ul>
        <li>The <strong>Landlord rents out</strong> accommodations and facilities intended for <strong>employee housing</strong>, and that the rented accommodation is meant for <strong>short-term residence</strong>.</li>
        <li>The <strong>Tenant and Landlord explicitly agree</strong> that the rented property may only be used for <strong>short-term accommodation by employees</strong> in the Tenant's service.</li>
        <li>The rented property is intended for residential purposes only, in accordance with municipal regulations.</li>
        <li>The Tenant is not allowed to assign a different purpose to the rented property without prior written permission from the Landlord.</li>
    </ul>

    <h2>RENTAL TERMS & CONDITIONS:</h2>
    <ul>
        <li>This rental agreement requires compliance with Dutch laws regarding rental and lease agreements for residential property.</li>
        <li>The general provisions of the rental agreement established on March 20, 2017, and filed on April 12, 2017, with The Hague District Court (registration number: 2017.21) apply.</li>
        <li>The agreement is for an <strong>indefinite period</strong> with a minimum term of <strong>[12 months]</strong>, starting from <strong>[Start Date]</strong>.</li>
        <li>Termination of the agreement must be done in writing via email, with a mutual notice period of <strong>one calendar month</strong>.</li>
        <li>The rental price may be adjusted annually on <strong>[July 1, 2024]</strong>, with a maximum increase of <strong>5%</strong>.</li>
    </ul>

    <h2>PAYMENT TERMS:</h2>
    <table>
        <tr>
            <td><strong>Monthly Rent</strong></td>
            <td>{{$property_price}} per month</td>
        </tr>
        <tr>
            <td><strong>Due Date</strong></td>
            <td>1st day of each calendar month</td>
        </tr>
        <tr>
            <td><strong>Bank Transfer Details</strong></td>
            <td>IBAN: NLXX RABO XXXX XXXX XX (RyanRent B.V.)</td>
        </tr>
    </table>

    <h2>USE OF THE PROPERTY:</h2>
    <ul>
        <li>The property is strictly for temporary residence (less than 6 months per occupant).</li>
        <li>The Tenant must maintain a resident registry and provide it to the Landlord if requested.</li>
        <li>Pets are not allowed without prior written consent from the Landlord.</li>
        <li>Any damage to the property caused by the Tenant or its occupants will be the responsibility of the Tenant.</li>
    </ul>

    <h2>SECURITY DEPOSIT:</h2>
    <p>The Tenant must pay a security deposit equal to **one month’s rent** before the lease start date. The deposit will be refunded after the lease ends, provided there are no damages or outstanding dues.</p>

    <h2>GOVERNING LAW:</h2>
    <p>This agreement is governed by the laws of **The Netherlands**, and any disputes shall be settled in Dutch courts.</p>

    <h2>SIGNATURES:</h2>
    <div class="signature">
        <table>
            <tr>
                <td>
                    <p><strong>Location: Vlaardingen</strong></p>
                    <p>_______________________</p>
                    <p>{{$tenant_name}}</p>
                    <p>(Tenant)</p>
                    <p>{{ $todays_date }}</p>
                </td>
                <td width="50"></td>
                <td>
                    <p><strong>Location: Vlaardingen</strong></p>
                    <p>_______________________</p>
                    <p>{{$contract_officer}}</p>
                    <p>(Landlord)</p>
                    <p>{{ $todays_date }}</p>
                </td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
