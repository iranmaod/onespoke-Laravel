<nav x-data="{ originalWidth: window.outerWidth, navOpen: window.outerWidth > 678 ? true : false, open: false }" x-on:resize.window="navOpen = (window.outerWidth > 768) ? true : false" @keydown.window.escape="open = false" @click.away="open = false" class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-no-wrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div class="md:flex-col md:items-stretch md:min-h-full md:flex-no-wrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">

        <button @click="navOpen = !navOpen" class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button">
            <i class="fas fa-bars"></i>
        </button>

        <a class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0 w-40" href="{{ route('admin.dashboard') }}">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>

        <!-- Mobile Dropdown and Profile Image -->
        <ul class="md:hidden items-center flex flex-wrap list-none">

            <li class="inline-block relative">
                <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md bg-transparent text-sm font-medium text-gray-700 focus:outline-none " aria-haspopup="true" aria-expanded="true">
                    <div class="items-center flex">
                        <span class="w-12 h-12 text-sm text-white bg-red-300 inline-flex items-center justify-center rounded-full">
                            {{ auth()->user()->initials }}
                        </span>
                    </div>
                </button>
                <div
                    style="left: -145px;"
                    x-show="open"
                    x-cloak
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute bg-white text-base float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                >

                    <div class="h-0 my-2 border border-solid border-gray-100"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </li>
        </ul>


        <div x-show="navOpen" x-cloak :class="{ 'm-2 py-3 px-6 md:m-0 md:py-0 md:px-0': navOpen }" class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded bg-white">

            <div class="md:min-w-full md:hidden block pb-4 mb-4">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0 w-40" href="{{ route('admin.dashboard') }}">
                            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button @click="navOpen = !navOpen" type="button" class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="my-4 hidden md:block lg:block md:min-w-full">

            <!-- Heading -->
            <h6 class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Menu
            </h6>

            <!-- Navigation -->
            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-xs uppercase py-3 font-bold block 0 {{ (request()->is('admin/dashboard')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                        Dashboard
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('admin.bikes.add') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/bikes/add')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-biking mr-2 text-sm"></i>
                        Add Products
                    </a>
                </li>
                <li class="items-center">
                    <a href="{{ route('admin.products') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/products')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-biking mr-2 text-sm"></i>
                        View Products
                    </a>
                </li>
                <li class="items-center">
                    <a href="{{ route('admin.bikes') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/bikes')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-biking mr-2 text-sm"></i>
                        Bikes
                    </a>
                </li>
                <li class="items-center">
                    <a href="{{ route('admin.order') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('all/orders')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-biking mr-2 text-sm"></i>
                        Orders
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('admin.suppliars') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/suppliars')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-building mr-2 text-sm"></i>
                       Suppliers
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('work.supplier.create') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('supplier/create')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-building mr-2 text-sm"></i>
                     Add Suppliers
                    </a>
                </li>
                <li class="items-center">
                    <a href="{{ route('admin.manufacturers') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/manufacturers')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-building mr-2 text-sm"></i>
                       Manufacturers
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('admin.genders') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/genders*')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-transgender-alt mr-2 text-sm"></i>
                        Genders
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('admin.categories') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/categories*')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-sitemap mr-2 text-sm"></i>
                        Categories
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('admin.conditions') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/conditions*')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-certificate mr-2 text-sm"></i>
                        Conditions
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('admin.types') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/types*')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-folder mr-2 text-sm"></i>
                        Types
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('admin.sizes') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/sizes*')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-ruler mr-2 text-sm"></i>
                        Sizes
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('admin.wheel-sizes') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/wheel-sizes*')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-circle mr-2 text-sm"></i>
                        Wheel Sizes
                    </a>
                </li>

                <li class="items-center">
                    <a href="{{ route('admin.users') }}" class="text-xs uppercase py-3 font-bold block {{ (request()->is('admin/users*')) ? 'text-blue-500 hover:text-blue-400' : 'text-gray-800 hover:text-gray-600' }}">
                        <i class="fas fa-users mr-2 text-sm"></i>
                        Users
                    </a>
                </li>

                <div class="h-0 my-1 border border-solid border-gray-100"></div>

                <li class="items-center">
                    <a href="{{ route('website.home') }}" class="text-xs uppercase py-3 font-bold block text-gray-800 hover:text-gray-600">
                        <i class="fas fa-globe mr-2 text-sm"></i>
                        Website
                    </a>
                </li>

                <li class="items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="text-xs uppercase py-3 font-bold block text-gray-800 hover:text-gray-600">
                            <i class="fas fa-sign-out-alt mr-2 text-sm"></i>
                            {{ __('Logout') }}
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
