@component('mail::message')
# New Message from {{ $message->user->displayName }}

Hi {{ $user->first_name }},

You have received a new message from {{ $message->user->displayName }} :

*{{ $message->message }}*

@component('mail::button', ['url' => route('website.account.messages')])
View Message
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
