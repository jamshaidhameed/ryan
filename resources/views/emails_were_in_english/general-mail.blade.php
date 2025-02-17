<x-mail::message>
   # {{ $mail_subject}}

    Dear {{ $receiver}},
    

    {{ $mail_message}}


    Thanks,<br>
    {{ env('Business_Title') }}
</x-mail::message>