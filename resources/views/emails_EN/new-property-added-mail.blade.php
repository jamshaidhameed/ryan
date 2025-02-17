<x-mail::message>
    # New Property Added

    Dear Admins,  

    Mr. {{$owner}} has recently added a new property to the system.  

    ## **Property Details**  
    - **Title:** {{$property->title_en}}  
    - **Price:** {{$property->price}}  
    - **Address:** {{$property->street_address}}  

    Please review the listing and take any necessary actions.  

    Best regards,  
    **{{ env('Business_Title') }}**
</x-mail::message>
