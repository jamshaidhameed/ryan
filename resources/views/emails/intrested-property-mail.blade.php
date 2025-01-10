<x-mail::message>
    # New property that match your intreste is added in ryanrent.


    Property: {{$property->title_en}}
    Price: {{$property->price}}

    Thanks
    {{ env('Business_Title') }}
</x-mail::message>