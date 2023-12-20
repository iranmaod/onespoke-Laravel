<section class="soldbike-sec2 pb-4 md:pb-12">
    <div class="container mx-auto px-12">
        <div class="row">
            <div class="grid pt-20 pb-20">
                <h3 class="text-3xl font-bold text-center">Listing <span class="orange"> Information </span></h3>
            </div>
            <div class="listing-form">
                <form id="new-listing-form" class="w-full md:w-3/4 mx-auto" action="{{ empty($bike) ? route('bike.store') : route('bike.update', ['bike' => $bike])  }}" method="post">

                    @if (!empty($bike))
                        @method('put')
                    @endif

                    <div class="form-control flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="title">
                                Ad Title <span class="text-red-400">*</span>
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="title" name="title" type="text" placeholder="The title of your listing" value="{{ $bike->title ?? '' }}">
                            <div class="error text-red-400"></div>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="form-control w-full px-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="description">
                                Description
                            </label>
                            <textarea rows="4" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="description" name="description" placeholder="More information about the bike (maximum 2,000 characters)">{{ $bike->description ?? '' }}</textarea>
                            <div class="error text-red-400"></div>
                        </div>
                    </div>

                    @if (auth()->user()->account_type === App\Models\User::BUSINESS)
                        <div class="flex flex-wrap -mx-3 mb-6 hidden">
                            <div class="form-control w-full px-3">
                                <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="description">
                                    Do you have more than one of these available to sell?
                                </label>
                                <div class="relative flex">
                                    <label class="flex items-center mr-5">
                                        <input type="radio" class="form-checkbox" value="0" name="more_than_one_available" {{ (empty($bike) || $bike->more_than_one_available === 0) ? 'checked' : '' }}>
                                        <span class="ml-2">No</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" class="form-checkbox" value="1" name="more_than_one_available" {{ (!empty($bike) && $bike->more_than_one_available === 1) ? 'checked' : '' }}>
                                        <span class="ml-2">Yes</span>
                                    </label>
                                </div>
                                <div class="error text-red-400"></div>
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-wrap -mx-3 mb-6 mb-6">
                        <div class="form-control w-full md:w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="manufacturer_id">
                                Brand <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="manufacturer_id" name="manufacturer_id">
                                    <option value="">Select</option>
                                    @foreach (\App\Models\Manufacturer::ordered()->get() as $manufacturer)
                                        <option value="{{ $manufacturer->id }}" {{ (!empty($bike) && $bike->manufacturer_id === $manufacturer->id) ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="error text-red-400"></div>
                        </div>

                        <div class="form-control w-full md:w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="frame_type_id">
                                Type <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="frame_type_id" name="frame_type_id">
                                    <option value="">Select</option>
                                    @foreach (\App\Models\FrameType::ordered()->get() as $frameType)
                                        <option value="{{ $frameType->id }}" {{ (!empty($bike) && $bike->frame_type_id === $frameType->id) ? 'selected' : '' }}>{{ $frameType->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="error text-red-400"></div>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="form-control w-full md:w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="model">
                                Model
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="model" name="model" type="text" placeholder="What's the model of your bike?" value="{{ $bike->model ?? '' }}">
                            <div class="error text-red-400"></div>
                        </div>

                        <div class="form-control w-full md:w-1/2 px-3 mb-3">

                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="condition_id">
                                Condition <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="condition_id" name="condition_id">
                                    <option value="">Select</option>
                                    @foreach (\App\Models\Condition::ordered()->get() as $condition)
                                        <option value="{{ $condition->id }}" {{ (!empty($bike) && $bike->condition_id === $condition->id) ? 'selected' : '' }}>{{ $condition->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="error text-red-400"></div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="form-control w-full md:w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="year">
                                Year
                            </label>
                            <div class="relative">
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="year" name="year" type="text" placeholder="Optional" value="{{ $bike->year ?? '' }}">
                            </div>
                            <div class="error text-red-400"></div>
                        </div>
                        <div class="form-control w-full md:w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="price">
                                Price <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="price" name="price" type="text" placeholder="" value="{{ empty($bike) ? '' : $bike->rawFormattedPrice() }}">
                            </div>
                            <div class="error text-red-400"></div>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="form-control w-full md:w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="uploaded_to_veloeye">
                                Is This Bike Uploaded To veloeye? <span class="text-red-400">*</span>
                                <button type="button" class="open-popper" data-popper="veloeye-tooltip">
                                    <i class="fa fa-info-circle orange"></i>
                                </button>
                            </label>

                            <div
                                class="hidden popper bg-white border-0 mb-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg"
                                id="veloeye-tooltip"
                            >
                                <div>
                                    <div class="bg-white text-gray opacity-75 p-3 mb-0 border border-solid rounded">
                                        {{ config('app.name') }} have partnered up with veloeye to help bring you the safest second hand bikes.
                                        <br><br>
                                        Please tick yes if you have registered your bike, and be sure to upload the frame number for a potential buyer to check on the veloeye database.
                                        <br><br>
                                        For more info, click <a class="orange font-bold" href="{{ route('website.veloeye') }}" target="_blank">HERE</a>
                                    </div>
                                </div>
                            </div>

                            <div class="relative flex">
                                <label class="flex items-center mr-5">
                                    <input type="radio" class="form-checkbox" value="0" name="uploaded_to_veloeye" {{ (empty($bike) || $bike->uploaded_to_veloeye === 0) ? 'checked' : '' }}>
                                    <span class="ml-2">No</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" class="form-checkbox" value="1" name="uploaded_to_veloeye" {{ (!empty($bike) && $bike->uploaded_to_veloeye === 1) ? 'checked' : '' }}>
                                    <span class="ml-2">Yes</span>
                                </label>
                            </div>
                            <div class="error text-red-400"></div>
                        </div>

                        <div class="form-control w-full md:w-1/2 px-3 mb-3">
                            <label class="block  tracking-wide text-gray-700 text-base font-bold mb-2" for="frame_number">
                                Frame Number <span class="required hidden text-red-400">*</span>
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="frame_number" name="frame_number" type="text" placeholder="Optional" value="{{ $bike->frame_number ?? '' }}">
                            <div class="error text-red-400"></div>
                        </div>
                    </div>

                    <h3 class="my-5 text-2xl font-bold orange">Other Details</h3>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="form-control w-full md:w-1/2 px-3 mb-3">

                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="frame_size_id">
                                Frame Size
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="frame_size_id" name="frame_size_id">
                                    <option value="">Select</option>
                                    @foreach (\App\Models\FrameSize::ordered()->get() as $frameSize)
                                        <option value="{{ $frameSize->id }}" {{ (!empty($bike) && $bike->frame_size_id === $frameSize->id) ? 'selected' : '' }}>{{ $frameSize->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="error text-red-400"></div>

                        </div>

                        <div class="form-control w-full md:w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="wheel_size_id">
                                Wheel Size
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="wheel_size_id" name="wheel_size_id">
                                    <option value="">Select</option>
                                    @foreach (\App\Models\WheelSize::ordered()->get() as $wheelSize)
                                        <option value="{{ $wheelSize->id }}" {{ (!empty($bike) && $bike->wheel_size_id === $wheelSize->id) ? 'selected' : '' }}>{{ $wheelSize->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="error text-red-400"></div>
                        </div>

                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="form-control w-full md:w-1/2 px-3 mb-3">

                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="gender_id">
                                Gender
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="gender_id" name="gender_id">
                                    <option value="">Select</option>
                                    @foreach (\App\Models\Gender::ordered()->get() as $gender)
                                        <option value="{{ $gender->id }}" {{ (!empty($bike) && $bike->gender_id === $gender->id) ? 'selected' : '' }}>{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="error text-red-400"></div>

                        </div>

                        <div class="form-control w-full md:w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="postcode">
                                Postcode (only the first part)
                            </label>
                            <div class="relative">
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="postcode" name="postcode" type="text" placeholder="Optional - e.g. EH1" value="{{ $bike->postcode ?? '' }}">
                            </div>
                            <div class="error text-red-400"></div>
                        </div>

                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="form-control w-full px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="additional_details">
                                Additional Details
                            </label>
                            <textarea rows="4" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="additional_details" name="additional_details" placeholder="Anything else not covered by the above (maximum 2,000 characters)">{{ $bike->additional_details ?? '' }}</textarea>
                            <div class="error text-red-400"></div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold">Photos</h2>

                    <p class="text-gray-500 my-3">
                        To help your listing sell, we strongly recommend that you attach 4-10 high-resolution photos. The maximum file size is 10MB per image, with 6000x4000 maximum dimensions.
                    </p>

                    <div class="grid w-full mx-auto my-2">
                        <div class="flex text-white px-6 py-4 border-0 rounded relative mb-4 bg-blue-400">
                            <span class="text-xl inline-block mr-5 align-middle">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="inline-block align-middle mr-8">
                                The images in your listing will be ordered as you see them below.<br><br>
                                To edit the order you can drag the images to customise the order they will be shown.
                            </span>
                        </div>
                    </div>

                    <div class="my-1">
                        <div class="form-control w-full">

                            <input
                                id="images"
                                type="file"
                                class="filepond"
                                name="images[]"
                                multiple
                                data-allow-reorder="true"
                                data-max-file-size="10MB"
                                data-max-files="10"
                                accept="image/png, image/jpeg, image/gif"
                            >

                            <div class="error text-red-400"></div>
                        </div>
                    </div>

                    <button type="submit" class="orange-btn rounded-xl shadow-3xl mt-3 mb-3 text-white pr-14 pl-14 uppercase">
                        {{ empty($bike) ? 'Publish!' : 'Update!' }}
                    </button>

                </form>
            </div>
        </div>
    </div>
</section>

@push('body')
    sell
@endpush

@push('scripts')
    <script src="{{ mix('js/sell.js') }}"></script>
@endpush
