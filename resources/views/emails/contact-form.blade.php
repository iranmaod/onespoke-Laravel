@component('mail::message')
# Contact Form enquiry from {{ $name }}

Hi,

{{ $name }} ({{$email }}) has submitted the contact form on the {{ config('app.name') }} website.

*{{ $message }}*

Thanks,<br>
{{ config('app.name') }}
@endcomponent
