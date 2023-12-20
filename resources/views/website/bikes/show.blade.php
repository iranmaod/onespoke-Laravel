<x-website.layout>

    <x-website.navbar />

    <x-website.hero>
        <section class="sold-bike1 all_bike-sec1 pt-28 pb-28">
            <div class="container mx-auto">
                <div class="row">
                    <div class="grid">
                        <h2 class="text-center text-4xl font-bold pb-3 uppercase text-white"><span class="orange">Bike </span> Details</h2>
                        <p class="text-center w-2/5 mx-auto text-base text-white"></p>
                    </div>
                </div>
            </div>
        </section>
    </x-website.hero>

    <div id="dynamic-gallery"></div>

    <section class="planet-sec pt-12 md:pt-24 pb-10 md:pb-24">
        <div class="container mx-auto">
            <div class="row">
                <div class="grid grid-cols-2 w-10/12 mx-auto pb-5 planet-grid">
                    <div class="pl-grid1">

                        <div class="flex">
                            <h1 class="f-arial text-4xl font-semibold blue">
                                {{ $bike->title }}
                            </h1>
                        </div>

                        @if (!empty($bike->model))
                            <p class="text-base font-semibold orange"{{ $bike->model }}</p>
                        @endif

                        <p class="text-2xl font-semibold">{{ $bike->formattedPrice() }}</p>

                        @auth
                            @if (request()->user()->isAdmin())
                                <p class="text-sm font-semibold text-gray-500">{{ $bike->view_count }} {{ Illuminate\Support\Str::plural('view', $bike->view_count) }}</p>

                        <p class="text-sm font-semibold orange">Posted {{ $bike->created_at->diffForHumans() }}</p>
                            @endif
                        @endauth
                    </div>

                </div>

                @auth
                    @if ($bike->user_id === request()->user()->id)
                        <div class="grid w-10/12 mx-auto pb-5">
                            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-300">
                                <span class="text-xl inline-block mr-5 align-middle">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="inline-block align-middle mr-8">
                                    This is your listing
                                </span>
                            </div>
                        </div>
                    @endif
                @endauth

                <div class="grid grid-cols-1 lg:grid-cols-2 w-10/12 mx-auto gap-10 bb-grid">

                    <div class="">

                        <div id="primary-slider" class="splide mb-4">
                            <div class="splide__track rounded-md">
                                <ul class="splide__list">
                                    @foreach ($bike->images as $image)
                                        <li class="splide__slide">
                                            <img class="" src="{{ $image->thumbUrl() }}" alt="{{ $bike->title }}">
                                            <div class="opacity-0 cursor-pointer bg-clip-border bg-black bg-no-repeat hover:opacity-70 duration-300 absolute inset-0 z-1 flex justify-center items-center text-base text-white font-semibold text-center p-2">
                                                <span class="text-2xl text-white">
                                                    <i class="fa fa-search"></i> Click to open gallery
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        @if ($bike->images->count() > 1)
                            <div id="secondary-slider" class="splide">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($bike->images as $image)
                                            <li class="splide__slide rounded-md">
                                                <img src="{{ $image->thumbUrl() }}" alt="{{ $bike->title }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="">
                        <div class="flex justify-between items-center space-x-20 mb-5">
                            <div>
                                <p class="text-3xl font-bold">Description</p>
                                <p class="text-sm font-semibold">ID: {{ $bike->getRouteKey() }}</p>

                                @if ($bike->user->account_type === App\Models\User::BUSINESS)
                                    @if (!empty($bike->more_than_one_available))
                                        <p class="text-sm font-semibold">More than one available</p>
                                    @endif
                                @endif
                            </div>

                            @auth
                                <div class="flex self-start">
                                    <form id="main-favourite-form" class="favourite-action" method="post" action="{{ request()->user()->favouriteBikes->contains($bike) ? route('favourites.unfavourite', $bike) : route('favourites.favourite', $bike) }}">

                                        @if (request()->user()->favouriteBikes->contains($bike))
                                            <input type="hidden" name="_method" value="delete">
                                        @endif

                                        <button type="submit" class="orange">
                                            <i class="{{ request()->user()->favouriteBikes->contains($bike) ? 'fas' : 'far' }} fa-heart heart"></i>
                                        </button>
                                    </form>
                                </div>
                            @endauth
                        </div>

                        @if ($bike->uploaded_to_veloeye)
                            <div class="p-5 rounded-md border border-blue-500 flex justify-between items-center">
                                <p class="mr-5">This bike has been uploaded to <a href="https://www.veloeye.com/" target="_blank" title="Veloeye">Veloeye</a></p>
                                <img src="/images/veloeye.jpg" alt="Veloeye" class="w-20"/>
                            </div>
                        @endif

                        <div class="my-5">
                            {!! nl2br($bike->description, false) !!}
                        </div>

                        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

                            <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Brand
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        {{ $bike->manufacturer->name }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Condition
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        {{ $bike->condition->name }}
                                    </p>
                                </div>
                            </div>

                            @if (!empty($bike->year))
                                <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                                    <div>
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Year
                                        </p>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{ $bike->year }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if (!empty($bike->frame_number))
                                <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                                    <div>
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Frame Number
                                        </p>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{ $bike->frame_number }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if (!empty($bike->frameType))
                                <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                                    <div>
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Frame Type
                                        </p>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{ $bike->frameType->name }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if (!empty($bike->frameSize))
                                <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                                    <div>
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Frame Size
                                        </p>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{ $bike->frameSize->name }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if (!empty($bike->wheelSize))
                                <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                                    <div>
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Wheel Size
                                        </p>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{ $bike->wheelSize->name }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if (!empty($bike->gender))
                                <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800">
                                    <div>
                                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Gender
                                        </p>
                                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                            {{ $bike->gender->name }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                        </div>

                        @if (!empty($bike->additional_details))
                            <h5 class="f-arial font-bold">Additional Details</h5>
                            <div class="my-5 text-gray-500">
                                {!! nl2br($bike->additional_details, false) !!}
                            </div>
                        @endif

                        <div class="grid sm:grid-cols-2 mt-10 bg-gray-100 p-4 rounded-lg space-x-4 items-center">
                            <div class="flex align-middle">
                                <div class="flex w-full space-x-4 mb-4 md:mb-0 items-center">

                                    <div class="w-20">
                                        <img class="w-20 rounded-full object-cover" src="{{ empty($bike->user->profileImage()) ? url('/images/empty-profile.png') : $bike->user->profileImage()->url() }}" alt="{{ $bike->user->displayName }}" />
                                    </div>

                                    <div class="flex flex-wrap w-full">
                                        <div>
                                            <div class="pl-3 font-bold">
                                                {{ $bike->user->displayName }}

                                                @if ($bike->user->is_verified)
                                                    <button data-popper="dropdown-verified" class="orange-bg text-white rounded-full text-center w-6 h-6 inline-block mx-1 open-popper">
                                                        <i class="fa fa-check text-xs"></i>
                                                    </button>

                                                    <div
                                                        id="dropdown-verified"
                                                        class="hidden popper bg-white border-0 mb-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg"
                                                    >
                                                        <div>
                                                            <div
                                                                class="bg-white text-gray opacity-75 p-3 mb-0 border border-solid rounded"
                                                            >
                                                                This tick box indicates this user has uploaded at least one form of ID which matches the name on their account
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="pl-3 text-sm">{{ $bike->user->accountType() }} Account</p>

                                            @if (!empty($bike->user->phone))
                                                <div class="pl-3 text-sm my-3">
                                                    <p class="f-arial font-bold">
                                                        Phone: <span class="text-gray-500">{{ $bike->user->phone }}</span>
                                                    </p>
                                                </div>
                                            @endif

                                            @auth
                                                <p class="pl-3 text-sm">
                                                    <a href="{{ route('user.profile', [$bike->user, $bike->user->slug]) }}" class="orange font-bold">View Profile</a>
                                                </p>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="">

                                @auth
                                    @if ($bike->user_id !== request()->user()->id)
                                        <button id="message-user" class="orange-btn px-5 text-xs rounded-xl font-semibold py-3 hover:bg-gray-500 hover:text-white md:float-right">
                                            Contact seller
                                        </button>
                                    @endif
                                @endauth

                                @guest
                                    <a class="orange-btn px-5 text-xs rounded-xl font-semibold py-3 hover:bg-gray-500 hover:text-white md:float-right" href="{{ route('login') }}">
                                        Log in to contact seller
                                    </a>
                                @endguest
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            @if (!empty ($bike->latitude) && !empty($bike->longitude))
                <div class="text-gray-600 body-font relative w-full mx-auto py-6 mx-auto justify-center flex sm:flex-nowrap flex-wrap">
                    <div class="w-10/12 bg-gray-300 rounded-lg overflow-hidden flex items-end justify-start relative h-96">
                        <iframe width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map" marginheight="0" marginwidth="0" scrolling="no" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q={{ urlencode($bike->location()) }}&amp;ie=UTF8&amp;t=&amp;z=13&amp;iwloc=B&amp;output=embed" style="filter: grayscale(0.1) contrast(1.9) opacity(0.8);"></iframe>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="card-section pt-20 b-product-sec">
        <div class="row">
            <div class="container mx-auto">
                <div class="grid col-1 pb-14 w-full mx-auto">
                    <h2 class="text-3xl font-semibold text-center f-arial">
                        Customers Also <span class="blue">Viewed These Bikes</span>
                    </h2>
                </div>

                <div id="also-viewed" class="flex flex-wrap featured-bikes w-3/4 mx-auto">
                    <!-- Listings will appear here -->
                </div>
            </div>
        </div>
    </section>


    <x-website.categories />
    <x-website.footer />

    @auth
        <!-- modal -->
        <div
            class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-30"
            id="message-user-modal"
        >
            <div
                class="relative top-20 mx-auto p-5 border w-4/5 sm:w-4/5 md:w-3/5 lg:w-3/5 xl:w-2/5 shadow-lg rounded-md bg-white"
            >
                <div class="flex flex-row justify-between py-6 mx-3 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                    <p class="font-bold text-lg text-gray-800">Message {{ $bike->user->displayName }}</p>
                    <button id="x" type="button">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="mt-5">

                    <form method="post" action="{{ route('user.message', [$bike->user, $bike->user->slug]) }}">

                        <div class="form-control w-full px-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="message">
                                Message
                            </label>
                            <textarea rows="4" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="message" name="message" placeholder="Could you give me more information about the bike?"></textarea>
                            <div class="error text-red-400"></div>
                        </div>

                        <div class="items-center text-center px-4 py-3">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-green-400 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-200"
                            >
                                Send
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endauth

    @push('body')
        bikes.show
    @endpush

    @push('scripts')

        @auth
            <script>
                var favouriteAction = '{{ route('favourites.favourite', $bike) }}';
                var unfavouriteAction = '{{ route('favourites.unfavourite', $bike) }}';
            </script>
        @endauth

        <script>
            var alsoViewedUrl = '{{ route('also-viewed.index', $bike) }}';

            var images = @json($bike->imageUrls());
        </script>

        <script src="{{ mix('js/bikes/show.js') }}"></script>
    @endpush

</x-website.layout>
