<x-website.layout>

    <x-website.navbar />

    <x-website.hero>
        <section class="sold-bike1 pt-36 pb-36">
            <div class="container mx-auto">
                <div class="row">
                    <div class="grid">
                        <h2 class="text-center text-4xl font-bold pb-3 uppercase text-white"><span class="orange">Contact </span> Us</h2>
                        <p class="text-center w-2/5 mx-auto text-base text-white"></p>
                    </div>
                </div>
            </div>
        </section>
    </x-website.hero>

    <x-website.contact-content />

    <x-website.footer />

    @push('scripts')
        <script src="{{ mix('js/contact-form.js') }}"></script>
    @endpush

</x-website.layout>
