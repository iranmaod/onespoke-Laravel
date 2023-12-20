<!-- Footer -->
<section class="blue-bg pt-14 pb-14">
    <div class="grid grid-cols-1 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2">
        <div class="foot1 flex justify-center items-center">
            <img src="/images/f-logo.png" class="" alt="{{ config('app.name') }}">
        </div>
        <div class="foot3 text-left flex justify-center items-center mt-4 lg:mt-0">
            <a href="https://www.facebook.com/officialonespoke" target="_blank" class="text-xl py-4 px-6  bg-white rounded hover:bg-gray-700"> <i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/officialonespoke/" target="_blank" class="text-xl py-4 px-6 mr-2 ml-2 bg-white rounded hover:bg-gray-700"> <i class="fab fa-instagram"></i></a>
            <!-- <a href="#" class="text-xl py-4 px-6 bg-white rounded hover:bg-gray-700"> <i class="fab fa-linkedin-in"></i></a> -->
        </div>

        <div class="content1 pt-9 px-1 flex flex-wrap justify-center items-center">
            <a href="{{ route('website.contact') }}" class="text-white mr-4">Contact Us</a>
            <a href="{{ route('website.about') }}" class="text-white mr-4">About</a>
            <a href="{{ route('website.terms-and-conditions') }}" class="text-white mr-4">Terms & Conditions</a>
            <a href="{{ route('website.privacy-policy') }}" class="text-white mr-4">Privacy Policy</a>
            <a href="{{ route('website.buying-tips') }}" class="text-white mr-4">Buying Tips</a>
            <!-- <a href="{{ route('website.bike-register') }}" class="text-white">Bike Register</a> -->
            <a href="{{ route('website.veloeye') }}" class="text-white">Veloeye</a>
        </div>

        <div class="content1 footer-copy flex justify-center items-center flex-wrap flex-col mt-4 lg:mt-0">
            <p class="text-sm text-white text-base">
                <i class="fas fa-phone-alt pr-2 orange"></i> 0330 121 0220
            </p>
            <p class="pt-3 text-sm text-white text-center text-xs">
                © Copyright {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved
            </p>
        </div>
    </div>
</section>

@push('styles')
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
    />
@endpush

@push('scripts')
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="{{ mix('js/script.js') }}"></script>

    @if (config('app.env') === 'production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-213387300-1">
        </script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-213387300-1');
        </script>
    @endif
@endpush
