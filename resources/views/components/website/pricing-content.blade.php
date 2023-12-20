<section class="text-gray-600 body-font overflow-hidden">
    <div class="container px-5 py-24 mx-auto">

        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Pricing</h1>

            <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-gray-500">
                Select the plan that's right for you
            </p>
        </div>

        <div class="flex flex-wrap -m-4 justify-between">
            <div class="p-4 xl:w-1/3 md:w-1/2 w-full mb-12">
                <h1 class="text-center my-3 font-bold">One-off</h1>

                <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative overflow-hidden">
                    <h2 class="hidden text-sm tracking-widest title-font mb-1 font-medium">Personal</h2>
                    <h1 class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                        <span>£9.99</span>
                        <span class="text-lg ml-1 font-normal text-gray-500">/listing</span>
                    </h1>

                    <p class="flex items-center text-gray-600 mb-2">
                        <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        Listing Advertised until it's sold*
                    </p>

                    <p class="flex items-center text-gray-600 mb-2">
                        <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        Access to support from {{ config('app.name') }} throughout your listing duration
                    </p>

                    <p class="flex items-center text-gray-600 mb-2">
                        <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        Pause Listing at any time
                    </p>

                    <p class="mt-12">* <span class="text-xs">(after 30 days your listing will be paused, until you log in and re activate - this measure is in place to ensure adverts on {{ config('app.name') }} are accurate and valid)</span></p>

                    <a href="{{ route('website.sell') }}" class="flex items-center mt-auto text-white bg-gray-400 border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">
                        Sell your bike
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <p class="text-xs text-gray-500 mt-3"></p>
                </div>
            </div>

            <div class="p-4 xl:w-1/3 md:w-1/2 w-full mb-12">

                <div class="price-plan flex mx-auto border-2 border-blue-500 rounded overflow-hidden mb-3 w-auto">
                    <button type="button" data-plan="monthly" class="w-1/2 py-1 px-4 bg-blue-500 text-white focus:outline-none">Monthly</button>
                    <button type="button" data-plan="annually" class="w-1/2 py-1 px-4 focus:outline-none">Annually</button>
                </div>

                <div class="h-full p-6 rounded-lg border-2 border-blue-500 flex flex-col relative overflow-hidden">
                    <span class="bg-blue-500 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">POPULAR</span>
                    <h2 class="hidden text-sm tracking-widest title-font mb-1 font-medium">BUSINESS</h2>

                    <h1 data-plan="monthly" class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                        <span>£79.99</span>
                        <span class="text-lg ml-1 font-normal text-gray-500">/month</span>
                    </h1>

                    <h1 data-plan="annually" class="hidden text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                        <span>£849.00</span>
                        <span class="text-lg ml-1 font-normal text-gray-500">/year</span>
                    </h1>

                    <p class="flex items-center text-gray-600 mb-2">
                        <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        Everything in the One-Off plan, PLUS:
                    </p>

                    <p class="flex items-center text-gray-600 mb-2">
                        <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        Up to 50 listings per month
                    </p>

                    <button class="flex items-center mt-auto text-white bg-blue-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-blue-600 rounded">
                        Subscribe
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <p class="text-xs text-gray-500 mt-3"></p>
                </div>
            </div>

        </div>
    </div>
</section>

@push('scripts')
    <script src="{{ mix('js/pricing.js') }}"></script>
@endpush
