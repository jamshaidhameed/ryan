<!DOCTYPE html>
<html>

<head>
    <title>Issue Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

        .logo img {
            height: 30px;
        }

        .address {
            display: inline-block;
            vertical-align: middle;
            color: #777777;
        }

        .contact-info {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        .table th {
            background-color: #f5f5f5;
        }

        .table th:first-child,
        .table td:first-child {
            width: 50px;
        }

        .table th:last-child,
        .table td:last-child {
            text-align: right;
        }

        .total-amount {
            margin-top: 20px;
        }

        .note {
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ public_path('backend/assets/images/logo.png')}}" alt="Logo">
            </div>
        </div>

        <div class="contact-info">
            <h6>Name: {{ env('Business_Title') }}</h6>
            <h6>Email: info@ryanrent.com</h6>
            <h6>Website: <a href="javascript:void(0);" class="link-primary">{{ env('website')}}</a></h6>
            <h6>Contact No: {{ env('contact_INFO') }}</h6>
            <h6>Address: {{ env('BUSINESS_ADDRESS') }}</h6>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Issue</th>
                    <th class="text-right">Cost</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>{{$issue_ticket->title}}</td>
                    <td class="text-right">{{$ticket->cost}}</td>
                </tr>
            </tbody>
        </table>
        <div class="total-amount">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Total amount</td>
                        <td class="text-right">{{$ticket->cost}} {{$ticket->paid == 1 ? 'Yes' : 'No'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>