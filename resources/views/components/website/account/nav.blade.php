
<ul class="flex flex-wrap justify-center sm:my-0 sm:space-x-4">
    <li class="w-3/4 sm:w-auto">
        <a class="text-center block border rounded py-2 px-4 hover:bg-blue-700 text-white {{ request()->routeIs('website.account.orders') ? 'orange-bg' : 'blue-bg' }}" href="{{ route('website.account.orders') }}" title="Messages">Orders</a>
    </li>
    <li class="w-3/4 sm:w-auto">
        <a class="text-center block border rounded py-2 px-4 hover:bg-blue-700 text-white {{ request()->routeIs('website.account.profile') ? 'orange-bg' : 'blue-bg' }}" href="{{ route('website.account.profile') }}" title="Edit Profile">Edit Profile</a>
    </li>

    <li class="w-3/4 sm:w-auto">
        <a class="text-center block border rounded py-2 px-4 hover:bg-blue-700 text-white {{ request()->routeIs('website.account.listings') ? 'orange-bg' : 'blue-bg' }}" href="{{ route('website.account.listings') }}" title="Your Listings">Your Listings</a>
    </li>

    <li class="w-3/4 sm:w-auto">
        <a class="text-center block border rounded py-2 px-4 hover:bg-blue-700 text-white {{ request()->routeIs('website.account.favourites') ? 'orange-bg' : 'blue-bg' }}" href="{{ route('website.account.favourites') }}" title="Favourites">Favourites</a>
    </li>

    <li class="w-3/4 sm:w-auto">
        <a class="text-center block border rounded py-2 px-4 hover:bg-blue-700 text-white {{ request()->routeIs('website.account.messages') ? 'orange-bg' : 'blue-bg' }}" href="{{ route('website.account.messages') }}" title="Messages">Messages</a>
    </li>

  

</ul>

<hr class="border-t-1 mt-8 md:mt-16 w-4/6 mx-auto">
