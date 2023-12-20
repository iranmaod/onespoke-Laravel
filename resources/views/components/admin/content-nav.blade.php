<!-- Nav -->
<nav class="w-full z-10 bg-transparent md:flex-row md:flex-no-wrap md:justify-start flex items-center p-4 bg-blue-600">
    <div class="w-full mx-auto items-center flex justify-between md:flex-no-wrap flex-wrap md:px-10 px-4">

        <a class="text-white text-sm uppercase  lg:inline-block font-semibold" href="{{ route('admin.dashboard') }}"></a>

        <!--
        <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
            <div class="relative flex w-full flex-wrap items-stretch">
                <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"><i class="fas fa-search"></i></span>
                <input type="text" placeholder="Search here..." class="px-3 py-3 placeholder-gray-400 border-gray-100 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10">
            </div>
        </form>
        -->

        <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false" class="relative text-left hidden md:inline-block">
            <div>
                <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md shadow-sm bg-transparent text-sm font-medium text-gray-700 focus:outline-none " aria-haspopup="true" aria-expanded="true">
                    <div class="items-center flex">
                        <span class="w-12 h-12 text-sm text-white bg-blue-300 inline-flex items-center justify-center rounded-full">
                            {{ auth()->user()->initials }}
                        </span>
                    </div>
                </button>
            </div>

            <!--
              Dropdown panel, show/hide based on dropdown state.

              Entering: "transition ease-out duration-100"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->
            <div
                x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
            >
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">

                    <div class="h-0 my-2 border border-solid border-gray-100"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</nav>
