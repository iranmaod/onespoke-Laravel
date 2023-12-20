<div class="flex flex-wrap py-2 {{ Illuminate\Support\Facades\Route::currentRouteName() === 'website.home' ? 'bg-transparent' : 'bg-gradient' }}">
    <div class="w-full px-4">
        <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-blueGray-500 rounded w-10/12 mx-auto">
            <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
                <div class="w-full relative flex justify-between lg:w-auto px-4 lg:static lg:block lg:justify-start">
                    <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white" href="{{ route('website.home') }}">
                        <img src="/images/logo.png" alt="" width="60%">
                    </a>
                    <button class="toggle-navbar text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <div class="lg:flex lg:flex-grow items-center hidden" id="example-collapse-navbar">
                    <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">

                        <li class="">
                            <a class="{{ request()->routeIs('website.home') ? 'orange' : '' }} px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-black hover:opacity-75" href="{{ route('website.home') }}">
                                HOME
                            </a>
                        </li>

                        <li class="">
                            <a class="{{ request()->routeIs('website.buy') ? 'orange' : '' }} px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-black hover:opacity-75" href="{{ route('website.buy') }}">
                                BUY
                            </a>
                        </li>

                        <li class="">
                            <a class="{{ request()->routeIs('website.sell') ? 'orange' : '' }} px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-black hover:opacity-75" href="{{ route('website.sell') }}">
                                SELL
                            </a>
                        </li>

                        <!--
                            <li class="">
                                <a class="{{ request()->routeIs('website.pricing') ? 'orange' : '' }} px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-black hover:opacity-75" href="{{ route('website.pricing') }}">
                                    PRICING
                                </a>
                            </li>
                        -->

                        @auth
                            <li class="">
                                <a class="{{ request()->routeIs('website.account.favourites') ? 'orange' : '' }} px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-black hover:opacity-75" href="{{ route('website.account.favourites') }}">
                                    FAVOURITES
                                </a>
                            </li>

                            <li class="">
                                <a class="{{ request()->routeIs('website.account.messages') ? 'orange' : '' }} px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-black hover:opacity-75 relative" href="{{ route('website.account.messages') }}">
                                    MESSAGES
                                    <span class="hidden unread-message-count inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full absolute w-4 h-4 -inset-y-1 right-0">0</span>
                                </a>
                            </li>
                        @endauth

                        @guest
                            <li class="">
                                <a class="rounded orange-btn px-3 py-2 mr-5 flex items-center text-xs uppercase font-bold leading-snug text-black hover:bg-gray-600 hover:text-white" href="{{ route('login') }}">
                                    LOG IN
                                </a>
                            </li>
                            <li class="">
                                <a class="rounded text-white blue-btn px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-black hover:bg-gray-600 hover:text-white" href="{{ route('register') }}">
                                    SIGN UP
                                </a>
                            </li>
                        @endguest

                        @auth

                            @if (auth()->user()->isAdmin())
                                <li class="">
                                    <a class="rounded orange-bg text-white px-3 py-2 mr-5 flex items-center text-xs uppercase font-bold leading-snug text-black hover:bg-gray-600 hover:text-white" href="/admin/dashboard">
                                       ADMIN
                                    </a>
                                </li>
                                <li class="">
                                    <a class="rounded orange-bg text-white px-3 py-2 mr-5 flex items-center text-xs uppercase font-bold leading-snug text-black hover:bg-gray-600 hover:text-white" href="/work">
                                       APP
                                    </a>
                                </li>
                            @endif

                            <li class="">
                                <a class="rounded text-white blue-btn px-3 py-2 mr-5 flex items-center text-xs uppercase font-bold leading-snug text-black hover:bg-gray-600 hover:text-white" href="{{ route('website.account.listings') }}">
                                    MY ACCOUNT
                                </a>
                            </li>

                            <li class="">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" class="rounded text-white blue-btn px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-black hover:bg-gray-600 hover:text-white">
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            </li>
                        @endauth
                        
                        <li style="margin-left: 10px">

                            <a title="Cart" href="{{ url('cart') }}" class="rounded text-white blue-btn px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-black hover:bg-gray-600 hover:text-white"><i class="fa fa-cart-plus"
                                aria-hidden="true"></i>Cart 
                              <span class="count px-1">{{Cart::content()->count()}}</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
</div>
