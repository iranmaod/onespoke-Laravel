<x-website.layout>

    <x-website.navbar />

    <x-website.account.header />

    <section class="card-section pb-20">
        <div class="row">

            <div class="container mx-auto">
                <div class="grid col-1 pb-14 w-2/3 mx-auto yl-head">
                    <h2 class="text-3xl font-semibold f-arial">Your Listings</h2>
                </div>

                <div id="active-listings" class="space-y-12"></div>

                <div class="grid col-1 pb-14 pt-14 w-2/3 mx-auto yl-head">
                    <h2 class="text-3xl font-semibold f-arial">
                        Bikes that you have sold
                    </h2>
                </div>

                <div id="sold-listings" class="space-y-12"></div>

            </div>
        </div>
    </section>

    <x-website.footer />

    @push('body')
        account.listings
    @endpush

    @push('scripts')
        <script>
            var listingsUrl = '{{ route('listings.index') }}';
        </script>
        <script src="{{ mix('js/account/listings.js') }}"></script>
    @endpush

</x-website.layout>
