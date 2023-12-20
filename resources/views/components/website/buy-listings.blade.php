<section class="pt-14">
    <form id="bike-search-form" method="get" action="{{ route('bike.index') }}">
        <div class="px-2 md:px-6 lg: px-8 mx-auto">
            <div class="row">
                <div class="flex flex-wrap justify-start w-full mx-auto all-bike-inner space-y-8">
                    <div class="py-5 w-full sm:w-full lg:w-1/5 filter-col1 h-64 lg:h-full overflow-hidden overflow-y-auto">

                        <div class="filter-inner">

                            <h2 class="text-xl uppercase font-semibold mb-5">Filter</h2>

                            <button id="clear-all" type="button" class="underline font-semibold my-5 inline-block">Clear All</button>

                            <div x-data="{selected: 'search'}">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'search' ? selected = 'search' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'search' ? '' : '-rotate-90'"></i> Search
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="search" x-bind:style="selected == 'search' ? 'max-height: ' + $refs.search.scrollHeight + 'px' : ''">
                                    <div class="w-full px-3">
                                        <input type="text" value="{{ request()->has('search') ? request()->get('search') : '' }}" name="search" id="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Search terms">
                                    </div>
                                </div>
                            </div>

                            <div x-data="{selected: null}" class="">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'veloeye' ? selected = 'veloeye' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'veloeye' ? '' : '-rotate-90'"></i> Veloeye
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="veloeye" x-bind:style="selected == 'veloeye' ? 'max-height: ' + $refs.veloeye.scrollHeight + 'px' : ''">
                                    <div class="w-full px-3 mb-3">

                                        <label class="flex items-center">
                                            <input type="checkbox" name="uploaded_to_veloeye" class="form-checkbox" value="1" {{ (request()->has('uploaded_to_veloeye') && request()->get('uploaded_to_veloeye') == 1) ? 'checked' : '' }}>
                                            <span class="ml-2">Only bikes on veloeye</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div x-data="{selected: null}">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'location' ? selected = 'location' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'location' ? '' : '-rotate-90'"></i> Location
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="location" x-bind:style="selected == 'location' ? 'max-height: ' + $refs.location.scrollHeight + 'px' : ''">
                                    <div class="w-full px-3">
                                        <input type="text" value="{{ request()->has('postcode') ? request()->get('postcode') : '' }}" name="postcode" id="postcode" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Postcode">
                                    </div>

                                    <div class="w-full px-3">
                                        <input type="number" value="{{ request()->has('distance') ? request()->get('distance') : '' }}" name="distance" id="distance" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Distance (miles)">
                                    </div>
                                </div>
                            </div>

                            <div x-data="{selected: null}">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'price' ? selected = 'price' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'price' ? '' : '-rotate-90'"></i> Price
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="price" x-bind:style="selected == 'price' ? 'max-height: ' + $refs.price.scrollHeight + 'px' : ''">
                                    <div class="form-control w-full md:w-1/2 px-3">
                                        <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="min_price">
                                            Min Price
                                        </label>
                                        <input value="{{ request()->has('min_price') ? request()->get('min_price') : '' }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="min_price" name="min_price" type="text" placeholder="">
                                    </div>
                                    <div class="form-control w-full md:w-1/2 px-3">
                                        <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="max_price">
                                            Max Price
                                        </label>
                                        <input value="{{ request()->has('max_price') ? request()->get('max_price') : '' }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="max_price" name="max_price" type="text" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div x-data="{selected: null}">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'condition' ? selected = 'condition' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'condition' ? '' : '-rotate-90'"></i> Condition
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="condition" x-bind:style="selected == 'condition' ? 'max-height: ' + $refs.condition.scrollHeight + 'px' : ''">
                                    <div class="w-full px-3">
                                        @foreach (\App\Models\Condition::ordered()->get() as $condition)
                                            @if ($filters->conditions->contains($condition))
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="conditions[]" class="form-checkbox" value="{{ $condition->id }}" {{ request()->has('conditions') && in_array($condition->id, request()->get('conditions')) ? 'checked' : '' }}>
                                                    <span class="ml-2">{{ $condition->name }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div x-data="{selected: null}">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'brand' ? selected = 'brand' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'brand' ? '' : '-rotate-90'"></i> Brand
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="brand" x-bind:style="selected == 'brand' ? 'max-height: ' + $refs.brand.scrollHeight + 'px' : ''">
                                    <div class="w-full px-3">
                                        @foreach (\App\Models\Manufacturer::ordered()->get() as $manufacturer)
                                            @if ($filters->manufacturers->contains($manufacturer))
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="manufacturers[]" class="form-checkbox" value="{{ $manufacturer->id }}" {{ request()->has('manufacturers') && in_array($manufacturer->id, request()->get('manufacturers')) ? 'checked' : '' }}>
                                                    <span class="ml-2">{{ $manufacturer->name }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div x-data="{selected: null}">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'bike_type' ? selected = 'bike_type' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'bike_type' ? '' : '-rotate-90'"></i> Bike Type
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="bike_type" x-bind:style="selected == 'bike_type' ? 'max-height: ' + $refs.bike_type.scrollHeight + 'px' : ''">
                                    <div class="w-full px-3">
                                        @foreach (\App\Models\FrameType::ordered()->get() as $frameType)
                                            @if ($filters->frameTypes->contains($frameType))
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="types[]" class="form-checkbox" value="{{ $frameType->id }}" {{ request()->has('types') && in_array($frameType->id, request()->get('types')) ? 'checked' : '' }}>
                                                    <span class="ml-2">{{ $frameType->name }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div x-data="{selected: null}">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'bike_size' ? selected = 'bike_size' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'bike_size' ? '' : '-rotate-90'"></i> Bike Size
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="bike_size" x-bind:style="selected == 'bike_size' ? 'max-height: ' + $refs.bike_size.scrollHeight + 'px' : ''">
                                    <div class="w-full px-3">
                                        @foreach (\App\Models\FrameSize::ordered()->get() as $frameSize)
                                            @if ($filters->frameSizes->contains($frameSize))
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="sizes[]" class="form-checkbox" value="{{ $frameSize->id }}" {{ request()->has('sizes') && in_array($frameSize->id, request()->get('sizes')) ? 'checked' : '' }}>
                                                    <span class="ml-2">{{ $frameSize->name }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div x-data="{selected: null}">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'wheel_size' ? selected = 'wheel_size' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'wheel_size' ? '' : '-rotate-90'"></i> Wheel Size
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="wheel_size" x-bind:style="selected == 'wheel_size' ? 'max-height: ' + $refs.wheel_size.scrollHeight + 'px' : ''">
                                    <div class="w-full px-3">
                                        @foreach (\App\Models\WheelSize::ordered()->get() as $wheelSize)
                                            @if ($filters->wheelSizes->contains($wheelSize))
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="wheel_sizes[]" class="form-checkbox" value="{{ $wheelSize->id }}" {{ request()->has('wheel_sizes') && in_array($wheelSize->id, request()->get('wheel_sizes')) ? 'checked' : '' }}>
                                                    <span class="ml-2">{{ $wheelSize->name }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div x-data="{selected: null}">
                                <h2 class="text-xl uppercase font-semibold pt-4 pb-4 border-t-2">
                                    <button type="button" class="font-semibold" @click="selected !== 'gender' ? selected = 'gender' : selected = null">
                                        <i class="fas fa-chevron-down blue transform" :class="selected === 'gender' ? '' : '-rotate-90'"></i> Gender
                                    </button>
                                </h2>

                                <div class="flex flex-wrap -mx-3 mb-3 relative overflow-hidden transition-all max-h-0 duration-700" x-ref="gender" x-bind:style="selected == 'gender' ? 'max-height: ' + $refs.gender.scrollHeight + 'px' : ''">
                                    <div class="w-full px-3">
                                        @foreach (\App\Models\Gender::ordered()->get() as $gender)
                                            @if ($filters->genders->contains($gender))
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="genders[]" class="form-checkbox" value="{{ $gender->id }}" {{ request()->has('genders') && in_array($gender->id, request()->get('genders')) ? 'checked' : '' }}>
                                                    <span class="ml-2">{{ $gender->name }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-span-2 w-full sm:w-full lg:w-4/5 filter-col2">
                        <div class="grid grid-cols-1 md:grid-cols-2 mx-0 lg:mx-8 sm:mb-4 md:mb-8 pb-2" style="border-bottom: 3px solid #0160A2; ">
                            <div class="mt-2">
                                <p id="total" class="mt-3"></p>
                            </div>
                            <div class="text-right">

                                <div class="flex flex-wrap justify-end mt-2">
                                    <div class="w-full md:px-3">
                                        <div class="relative">

                                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="order" name="order">
                                                <option value="price_low_to_high">Price (low to high)</option>
                                                <option value="price_high_to_low">Price (high to low)</option>
                                                <option value="newest" selected>Newest</option>
                                                <option value="oldest">Oldest</option>
                                            </select>

                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-3 pl-5 hidden">
                                        <a href="#!" class="text-lg pr-3"><i class="fas fa-th"></i></a>
                                        <a href="#!" class="text-lg"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="listings" class="flex flex-wrap justify-start mx-auto">
                            <div class="text-center w-full text-2xl my-12">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </div>

                        <div class="grid text-center mt-14">
                            <div>
                                <button type="submit" class="blue-btn text-white rounded-xl uppercase shadow-2xl">
                                    Search All Bikes
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</section>


@push('body')
    buy
@endpush

@push('scripts')
    <script src="{{ mix('js/buy.js') }}"></script>
@endpush
