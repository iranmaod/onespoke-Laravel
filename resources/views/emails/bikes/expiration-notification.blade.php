@component('mail::message')
# One of your {{ config('app.name') }} listings have expired

Hi {{ $bike->user->first_name }},

One of your listings - **{{ $bike->title }}** - has just expired on {{ config('app.name') }} after being published for 30 days.

Don't worry, you can publish it again for another 30 days from the account section of {{ config('app.name') }} by clicking on the button below.

Alternatively, if you have sold the bike, you can also mark it as sold.

@component('mail::button', ['url' => route('website.account.listings')])
    View Your Listings
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
