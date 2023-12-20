<div x-data="{ open: @entangle('open') }">

    <x-admin.off-canvas>
        <div>
            <h3 class="text-2xl font-semibold text-gray-900">
                {{ empty($bike) || !$bike->exists ? 'Add New Bike' : 'Edit Bike: ' . $bike->getRouteKey() . ' ' . $bike->title }}
            </h3>

            @if (!empty($bike) && !$bike->trashed())

                <div class="my-3">

                    <form wire:submit.prevent="delete({{ $bike }})">

                        <div class="space-x-3 flex items-center">

                            <span class="inline-flex rounded-md shadow-sm">
                                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 pointer-events-none" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition duration-150 ease-in-out">
                                    <span wire:loading.remove wire:target="delete({{ $bike }})">
                                        Delete
                                    </span>

                                    <span wire:loading wire:target="delete({{ $bike }})">
                                        Deleting <i class="fas fa-spinner fa-spin inline-block ml-2"></i>
                                    </span>
                                </button>
                            </span>

                            <span
                                x-data="{ deleted: false }"
                                x-init="
                                    @this.on('notify-deleted', () => {
                                        if (deleted === false) setTimeout(() => { deleted = false }, 2500);
                                        deleted = true;
                                    })
                                "
                                x-show.transition.out.duration.1000ms="deleted"
                                x-cloak
                                class="text-red-600"
                            >
                                Deleted!
                            </span>
                        </div>

                    </form>
                </div>
            @endif

            @if (!empty($bike) && !$bike->paused && $bike->published && !$bike->sold)

                <div>

                    <form wire:submit.prevent="pause({{ $bike }})">

                        <div class="space-x-3 flex items-center">

                            <span class="inline-flex rounded-md shadow-sm">
                                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 pointer-events-none" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-700 transition duration-150 ease-in-out">
                                    <span wire:loading.remove wire:target="pause({{ $bike }})">
                                        Pause
                                    </span>

                                    <span wire:loading wire:target="pause({{ $bike }})">
                                        Pausing <i class="fas fa-spinner fa-spin inline-block ml-2"></i>
                                    </span>
                                </button>
                            </span>
                        </div>

                    </form>

                </div>
            @endif

            @if (!empty($bike) && $bike->paused && $bike->published && !$bike->sold)

                <div>

                    <form wire:submit.prevent="unpause({{ $bike }})">

                        <div class="space-x-3 flex items-center">

                            <span class="inline-flex rounded-md shadow-sm">
                                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 pointer-events-none" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:shadow-outline-yellow active:bg-blue-700 transition duration-150 ease-in-out">
                                    <span wire:loading.remove wire:target="unpause({{ $bike }})">
                                        Unpause
                                    </span>

                                    <span wire:loading wire:target="unpause({{ $bike }})">
                                        Unpausing <i class="fas fa-spinner fa-spin inline-block ml-2"></i>
                                    </span>
                                </button>
                            </span>
                        </div>

                    </form>

                </div>
            @endif

            @if (!empty($bike))

                @if ($bike->images->count() > 0)
                    <div class="my-5">
                        @foreach ($bike->images as $image)
                            <img class="h-48 rounded my-3 mx-3 inline-block" src="{{ $image->url() }}">
                        @endforeach
                    </div>
                @endif

                <div class="my-3 text-sm">
                    Status: {{ $bike->status }}
                </div>

                <div class="my-3 text-sm">
                    Created At: {{ $bike->created_at->format('d/m/Y') }}
                </div>

                <div class="my-3 text-sm">
                    Number of Pauses: {{ $bike->pauses()->count() }}
                </div>

                    <div class="my-3 text-sm">
                        Pause Total: {{ $bike->formattedPauseTotal() }}
                    </div>

                @if ($bike->published)
                    <div class="my-3 text-sm">
                        Due to Expire On: {{ $bike->endDate()->format('d/m/Y H:i') }}
                    </div>
                @endif

                <div class="my-3 text-sm">
                    Views: {{ $bike->view_count }}
                </div>

                <div class="my-3 text-sm">
                    Number of Times Favourited: {{ $bike->favouritedUsers->count() }}
                </div>
            @endif

            <form wire:submit.prevent="save">

                <div class="mt-6 sm:mt-5">

                    <x-input.group label="Title" for="title" :error="$errors->first('title')">
                        <x-input.text wire:model.defer="title" id="title" />
                    </x-input.group>

                    <x-input.group label="Description" for="description" :error="$errors->first('description')" help-text="">

                        <div
                            x-data="{ trix: @entangle('description').defer }"
                            x-on:trix-change="trix = $event.target.value"
                        >
                            <input id="description" name="description" type="hidden" />
                            <div wire:ignore>
                                <trix-editor x-model.debounce.300ms="trix" wire:key="description" input="description" class="form-textarea block bg-white border-gray-300 w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></trix-editor>
                            </div>
                            @error('description') <span class="error">{{ $message }}</span> @enderror
                        </div>

                    </x-input.group>

                    <x-input.group label="Manufacturer" for="manufacturerId" :error="$errors->first('manufacturerId')">
                        <x-input.select wire:model.defer="manufacturerId" id="manufacturerId">
                            <option value="">Select Manufacturer</option>
                            @foreach (\App\Models\Manufacturer::ordered()->get() as $manufacturer)
                                <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group label="Model" for="model" :error="$errors->first('model')">
                        <x-input.text wire:model.defer="model" id="model" />
                    </x-input.group>

                    <x-input.group label="Frame Type" for="frameTypeId" :error="$errors->first('frameTypeId')">
                        <x-input.select wire:model.defer="frameTypeId" id="frameTypeId">
                            <option value="">Select Frame Type</option>
                            @foreach (\App\Models\FrameType::ordered()->get() as $frameType)
                                <option value="{{ $frameType->id }}">{{ $frameType->name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group label="Condition" for="conditionId" :error="$errors->first('conditionId')">
                        <x-input.select wire:model.defer="conditionId" id="conditionId">
                            <option value="">Select Condition</option>
                            @foreach (\App\Models\Condition::ordered()->get() as $condition)
                                <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group label="Frame Number" for="frameNumber" :error="$errors->first('frameNumber')">
                        <x-input.text wire:model.defer="frameNumber" id="frameNumber" />
                    </x-input.group>

                    <x-input.group label="Uploaded to Bike Register?" for="uploadedToBikeRegister" :error="$errors->first('uploadedToBikeRegister')">
                        <x-input.checkbox wire:model.defer="uploadedToBikeRegister" id="uploadedToBikeRegister" />
                    </x-input.group>

                    <x-input.group label="Price (£)" for="price" :error="$errors->first('price')">
                        <x-input.text wire:model.defer="price" id="price" />
                    </x-input.group>

                    <x-input.group label="Year" for="year" :error="$errors->first('year')">
                        <x-input.text wire:model.defer="year" id="year" />
                    </x-input.group>

                    <x-input.group label="Frame Size" for="frameSizeId" :error="$errors->first('frameSizeId')">
                        <x-input.select wire:model.defer="frameSizeId" id="frameSizeId">
                            <option value="">Select Frame Size</option>
                            @foreach (\App\Models\FrameSize::ordered()->get() as $frameSize)
                                <option value="{{ $frameSize->id }}">{{ $frameSize->name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group label="Wheel Size" for="wheelSizeId" :error="$errors->first('wheelSizeId')">
                        <x-input.select wire:model.defer="wheelSizeId" id="wheelSizeId">
                            <option value="">Select Wheel Size</option>
                            @foreach (\App\Models\WheelSize::ordered()->get() as $wheelSize)
                                <option value="{{ $wheelSize->id }}">{{ $wheelSize->name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group label="Gender" for="genderId" :error="$errors->first('genderId')">
                        <x-input.select wire:model.defer="genderId" id="genderId">
                            <option value="">Select Gender</option>
                            @foreach (\App\Models\Gender::ordered()->get() as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group label="Postcode" for="postcode" :error="$errors->first('postcode')">
                        <x-input.text wire:model.defer="postcode" id="postcode" />
                    </x-input.group>

                    <x-input.group label="Additional Details" for="additionalDetails" :error="$errors->first('additionalDetails')" help-text="">

                        <div
                            x-data="{ trix: @entangle('additionalDetails').defer }"
                            x-on:trix-change="trix = $event.target.value"
                        >
                            <input id="additionalDetails" name="additionalDetails" type="hidden" />
                            <div wire:ignore>
                                <trix-editor x-model.debounce.300ms="trix" wire:key="additionalDetails" input="additionalDetails" class="form-textarea block bg-white border-gray-300 w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></trix-editor>
                            </div>
                            @error('additionalDetails') <span class="error">{{ $message }}</span> @enderror
                        </div>

                    </x-input.group>

                    @if (!empty($bike) && $bike->user->account_type === App\Models\User::BUSINESS)
                        <x-input.group label="More Than One Available?" for="moreThanOneAvailable" :error="$errors->first('moreThanOneAvailable')">
                            <x-input.checkbox wire:model.defer="moreThanOneAvailable" id="moreThanOneAvailable" />
                        </x-input.group>
                    @endif

                    <x-input.group label="Published?" for="published" :error="$errors->first('published')">
                        <x-input.checkbox wire:model.defer="published" id="published" />
                    </x-input.group>

                    <x-input.group label="Sold?" for="sold" :error="$errors->first('sold')">
                        <x-input.checkbox wire:model.defer="sold" id="sold" />
                    </x-input.group>

                </div>

                <div class="border-t border-gray-200 pt-5">
                    <div class="space-x-3 flex justify-end items-center">
                        <span
                            x-data="{ open: false }"
                            x-init="
                                @this.on('notify-saved', () => {
                                    if (open === false) setTimeout(() => { open = false }, 2500);
                                    open = true;
                                })
                            "
                            x-show.transition.out.duration.1000ms="open"
                            x-cloak
                            class="text-green-600"
                        >
                            Saved!
                        </span>

                        <span class="inline-flex rounded-md shadow-sm">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                                Save
                            </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </x-admin.off-canvas>

    <!-- Header -->
    <div class="relative bg-blue-600 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>


            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 md:px-10 mx-auto w-full -m-24">

        <div class="flex flex-wrap mt-4">
            <div class="w-full xl:w-12/12 mb-12 xl:mb-0 px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-gray-800">
                                    Bikes
                                </h3>
                            </div>
                            <div class="relative w-full px-4 pr-0 max-w-full flex-grow flex-1 text-right">
                                <button
                                    wire:click="addBike()"
                                    @keydown.window.escape="open = false"
                                    class="hidden bg-blue-500 text-white active:bg-blue-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                                    type="button"
                                >
                                    Add bike
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        x-data=""
                        x-init=""
                        class="block w-full overflow-x-auto"
                    >

                        <div class="px-2 mb-4 flex justify-between items-center">

                            <div class="flex-1 pr-2">
                                <div class="relative">
                                    <x-input.text wire:model.debounce.500ms="search" id="search" placeholder="Title" />
                                </div>
                            </div>

                        </div>

                        <div class="overflow-y-auto">
                            <table
                                x-ref=""
                                class="items-center w-full bg-transparent border-collapse"
                            >
                                <thead>
                                <tr>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Title
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        ID
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        User
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Price
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Status
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Created At
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bikes as $bike)
                                        <tr
                                            wire:click="setBike({{ $bike->id }})"
                                            class="cursor-pointer hover:bg-indigo-50 bg-{{ $bike->rowColour() }}"
                                        >

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                <a class="text-blue-600 hover:text-blue-500" href="{{ route('bike.show', [$bike->getRouteKey(), $bike->slug]) }}" target="_blank" title="View Bike">{{ $bike->title }}</a>
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $bike->getRouteKey() }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                <a class="text-blue-600 hover:text-blue-500" href="{{ route('user.profile', [$bike->user->getRouteKey(), $bike->user->slug]) }}" target="_blank" title="View Profile">{{ $bike->user->displayName }}</a>
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $bike->formattedPrice() }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $bike->status }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $bike->created_at->format('d/m/Y H:i') }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="my-4 px-2">
                        {{ $bikes->links() }}
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>