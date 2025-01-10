<x-mail::message>
    # New Property added

    Dear Admins,
    Mr. {{$owner}} has recently added new property.

    Property details
    Title: {{$property->title_en}}
    Price: {{$property->price}}
    Address: {{$property->street_address}}


    Thanks,<br>
    {{ env('Business_Title') }}
</x-mail::message>