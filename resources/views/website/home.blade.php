<x-website.layout>

    <x-website.hero>
        <section class="home-slider">
            <div class="container mx-auto">

                <x-website.navbar />

                <div class="row">
                    <div class="bg-cover bg-center text-white py-24 px-10">
                        <div class="hero-banner space-y-12">

                            <h1 class="text-5xl leading-tight uppercase font-extrabold">
                                <span class="orange">Discover</span><span class="dark"> your next</span> <span class="blue">Bike</span>
                            </h1>

                            <form action="{{ route('website.buy') }}" class="w-full max-w-lg index-form">
                                <div class="flex flex-wrap">

                                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded-xl py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="postcode" name="postcode" type="text" placeholder="Postcode">
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 h-12">

                                        <div class="relative" style="top: -15px;">
                                            <div id="slider-value" class="text-center text-gray-700">10</div>
                                            <input id="slider" type="range" name="distance" min="0" max="500" value="30" step="5">
                                        </div>
                                    </div>

                                    <button type="submit" class="shadow-2xl orange-btn mt-5 py-4 px-8 text-black font-semibold uppercase text-base rounded-2xl hover:bg-gray-400 hover:text-gray-800 w-full">
                                        FIND MY NEXT BIKE
                                    </button>
                                </div>
                            </form>

                            <div class="w-full max-w-lg">
                                <div class="text-center text-gray-700 font-bold text-sm mb-12">OR</div>
                                <a href="{{ route('website.sell') }}" title="Sell Your Bike" class="blue-btn py-4 shadow-2xl px-12 flex justify-center text-white font-semibold uppercase text-base rounded-2xl hover:bg-gray-400 hover:text-gray-800 w-full">
                                    SELL MY BIKE
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- container -->
                </div>
            </div>
        </section>

    </x-website.hero>

    <x-website.listings />
    <x-website.categories />

    <x-website.footer />

    @push('body')
        website.home
    @endpush

    @push('scripts')
        <script>
            var featuredUrl = '{{ route('featured.index') }}';
        </script>
        <script src="{{ mix('js/home.js') }}"></script>
    @endpush

</x-website.layout>
