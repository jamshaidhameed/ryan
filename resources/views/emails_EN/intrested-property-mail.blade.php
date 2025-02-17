<x-mail::message>
    # A New Property Matching Your Interest is Now Available on RyanRent!  

    We’ve just added a new property that matches your preferences.  

    ## **Property Details**  
    - **Title:** {{$property->title_en}}  
    - **Price:** €{{ number_format($property->price, 2) }}  

    Visit our platform to explore this property and find your perfect match.  

    Best regards,  
    **{{ env('Business_Title') }}**
</x-mail::message>
