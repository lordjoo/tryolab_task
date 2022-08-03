@component('mail::message')
# Student Order Fixed

Job is completed with status {{$status}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
