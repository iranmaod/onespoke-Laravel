<div x-data="{ open: @entangle('open') }">

    <x-admin.off-canvas>
        <div>
            <h3 class="text-2xl font-semibold text-gray-900">{{ empty($wheelSize) || !$wheelSize->exists ? 'Add New Wheel Size' : 'Edit Wheel Size: ' . $wheelSize->name }}</h3>

            <form wire:submit.prevent="save">

                <div class="mt-6 sm:mt-5">

                    <x-input.group label="Name" for="name" :error="$errors->first('name')">
                        <x-input.text wire:model.defer="name" id="name" />
                    </x-input.group>

                    <x-input.group label="Active?" for="active" :error="$errors->first('active')">
                        <x-input.checkbox wire:model.defer="active" id="active" />
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
                                    Sizes
                                </h3>
                            </div>
                            <div class="relative w-full px-4 pr-0 max-w-full flex-grow flex-1 text-right">
                                <button
                                    wire:click="addWheelSize()"
                                    @keydown.window.escape="open = false"
                                    class="bg-blue-500 text-white active:bg-blue-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                                    type="button"
                                >
                                    Add wheel size
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
                                    <x-input.text wire:model.debounce.500ms="search" id="search" placeholder="Name" />
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
                                        Name
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Status
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wheelSizes as $wheelSize)
                                        <tr
                                            wire:click="setWheelSize({{ $wheelSize->id }})"
                                            class="cursor-pointer hover:bg-indigo-50"
                                        >

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $wheelSize->name }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $wheelSize->trashed() ? 'Deleted' : 'Active' }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="my-4 px-2">
                        {{ $wheelSizes->links() }}
                    </div>

                </div>
            </div>

        </div>


    </div>
</div>
