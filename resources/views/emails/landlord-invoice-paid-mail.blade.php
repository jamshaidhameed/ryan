<x-mail::message>
    # Invoice paid
    Dear {{$owner_name}}

    The invoice for the property named {{$property_name}} has been paid for the month {{$invoice_month}}.
    Amount: {{price($invoice_amount)}}
    Thanks
    {{ env('Business_Title') }}
</x-mail::message>