<x-website.layout>

    <x-website.navbar />

    <x-website.account.header />

    <section class="card-section favourite-cards pt-14 pb-20">
        <div class="row">
            <div class="container mx-auto">

                <div class="grid col-1 pb-14 w-3/4 mx-auto">
                    <h2 class="text-3xl font-semibold f-arial text-center">Favourites</h2>
                </div>

                <div id="favourites" class="flex flex-wrap justify-center featured-bikes w-3/4 mx-auto">

                </div>

            </div>
        </div>
    </section>

    <x-website.footer />

    @push('body')
        account.favourites
    @endpush

    @push('scripts')
        <script>
            var favouritesUrl = '{{ route('favourites.index') }}';
        </script>
        <script src="{{ mix('js/account/favourites.js') }}"></script>
    @endpush

</x-website.layout>
