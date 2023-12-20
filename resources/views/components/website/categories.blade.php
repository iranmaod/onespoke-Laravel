
@if ($filters->frameTypes->count() >= 3)
    <section class="category-section pt-20 pb-20">
        <div class="row">

            <div class="mx-auto">
                <div class="grid col-1 justify-center pb-14">
                    <div>
                        <h2 class="text-5xl font-extrabold dark">SHOP BY  <span class="orange">CATEGORIES</span></h2>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center w-9/12 mx-auto cycle-grid">

                    <!-- Swiper -->
                    <div class="swiper category-swiper">
                        <div class="swiper-wrapper">

                            @if ($filters->frameTypes->contains(16))
                                <div class="swiper-slide">
                                    <div class="p-5 c_cycle1">

                                        <a href="{{ route('website.buy', ['types' => [16]]) }}" title="Road Bikes">
                                            <div class="max-w-sm rounded-full overflow-hidden shadow-lg pb-12 pt-5 bg-gray-100 card">
                                                <img class="w-2/3 mx-auto" src="/images/c-cycle.png" alt="Road Bikes">
                                                <div class="px-6 py-4 h-20">
                                                    <div class="text-lg text-center font-bold">Road Bikes</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($filters->frameTypes->contains(21))
                                <div class="swiper-slide">
                                    <div class="p-5 c_cycle1">

                                        <a href="{{ route('website.buy', ['types' => [21]]) }}" title="Mountain Bikes">
                                            <div class="max-w-sm rounded-full overflow-hidden shadow-lg pb-12 pt-5 bg-gray-100 card">
                                                <img class="w-2/3 mx-auto" src="/images/c-cycle2.png" alt="Mountain Bikes">
                                                <div class="px-6 py-4 h-20">
                                                    <div class="text-lg text-center font-bold">Mountain Bikes</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($filters->frameTypes->contains(20))
                                <div class="swiper-slide">
                                    <div class="p-5 c_cycle1">

                                        <a href="{{ route('website.buy', ['types' => [20]]) }}" title="Gravel Bikes">
                                            <div class="max-w-sm rounded-full overflow-hidden shadow-lg pb-12 pt-5 bg-gray-100 card">
                                                <img class="w-2/3 mx-auto" src="/images/c-cycle3.png" alt="Gravel Bikes">
                                                <div class="px-6 py-4 h-20">
                                                    <div class="text-lg text-center font-bold">Gravel Bikes</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($filters->frameTypes->contains(15))
                                <div class="swiper-slide">
                                    <div class="p-5 c_cycle1">

                                        <a href="{{ route('website.buy', ['types' => [15]]) }}" title="Hybrid Bikes">
                                            <div class="max-w-sm rounded-full overflow-hidden shadow-lg pb-12 pt-5 bg-gray-100 card">
                                                <img class="w-2/3 mx-auto" src="/images/c-cycle4.png" alt="Hybrid Bikes">
                                                <div class="px-6 py-4 h-20">
                                                    <div class="text-lg text-center font-bold">Hybrid Bikes</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($filters->frameTypes->contains(9))
                                <div class="swiper-slide">
                                    <div class="p-5 c_cycle1">

                                        <a href="{{ route('website.buy', ['types' => [9]]) }}" title="E-Bikes">
                                            <div class="max-w-sm rounded-full overflow-hidden shadow-lg pb-12 pt-5 bg-gray-100 card">
                                                <img class="w-2/3 mx-auto" src="/images/c-cycle5.png" alt="E-Bikes">
                                                <div class="px-6 py-4 h-20">
                                                    <div class="text-lg text-center font-bold">E-Bikes</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($filters->frameTypes->contains(8))
                                <div class="swiper-slide">
                                    <div class="p-5 c_cycle1">

                                        <a href="{{ route('website.buy', ['types' => [8]]) }}" title="Kid's Bikes">
                                            <div class="max-w-sm rounded-full overflow-hidden shadow-lg pb-12 pt-5 bg-gray-100 card">
                                                <img class="w-2/3 mx-auto" src="/images/c-cycle6.png" alt="Kid's Bikes">
                                                <div class="px-6 py-4 h-20">
                                                    <div class="text-lg text-center font-bold">Kid's Bikes</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($filters->frameTypes->contains(3))
                                <div class="swiper-slide">
                                    <div class="p-5 c_cycle1">

                                        <a href="{{ route('website.buy', ['genders' => [3]]) }}" title="Ladies Bikes">
                                            <div class="max-w-sm rounded-full overflow-hidden shadow-lg pb-12 pt-5 bg-gray-100 card">
                                                <img class="w-2/3 mx-auto" src="/images/c-cycle7.png" alt="Ladies Bikes">
                                                <div class="px-6 py-4 h-20">
                                                    <div class="text-lg text-center font-bold">Ladies Bikes</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($filters->frameTypes->contains(10))
                                <div class="swiper-slide">
                                    <div class="p-5 c_cycle1">

                                        <a href="{{ route('website.buy', ['types' => [10]]) }}" title="Folding Bikes">
                                            <div class="max-w-sm rounded-full overflow-hidden shadow-lg pb-12 pt-5 bg-gray-100 card">
                                                <img class="w-2/3 mx-auto" src="/images/c-cycle8.png" alt="Folding Bikes">
                                                <div class="px-6 py-4 h-20">
                                                    <div class="text-lg text-center font-bold">Folding Bikes</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($filters->frameTypes->contains(7))
                                <div class="swiper-slide">
                                    <div class="p-5 c_cycle1">

                                        <a href="{{ route('website.buy', ['types' => [7]]) }}" title="BMX">
                                            <div class="max-w-sm rounded-full overflow-hidden shadow-lg pb-12 pt-5 bg-gray-100 card">
                                                <img class="w-2/3 mx-auto" src="/images/c-cycle9.png" alt="BMX">
                                                <div class="px-6 py-4 h-20">
                                                    <div class="text-lg text-center font-bold">BMX</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="swiper-button-next button_shadow"></div>
                        <div class="swiper-button-prev button_shadow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="category-section pt-8 pb-8">
    </section>
@endif
