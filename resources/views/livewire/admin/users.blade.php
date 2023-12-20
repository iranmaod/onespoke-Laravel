<div x-data="{ open: @entangle('open') }">

    <x-admin.off-canvas>
        <div>
            <h3 class="text-2xl font-semibold text-gray-900">{{ empty($user) || !$user->exists ? 'Add New User' : 'Edit User: ' . $user->name }}</h3>

            @if (!empty($user))
                <a class="orange block my-5" href="{{ route('user.profile', [$user->getRouteKey(), $user->slug]) }}" target="_blank" title="View Profile">View Profile</a>
            @endif

            <form wire:submit.prevent="save">

                <div class="mt-6 sm:mt-5">

                    <x-input.group label="First Name" for="name" :error="$errors->first('first_name')">
                        <x-input.text wire:model.defer="first_name" id="first-name" />
                    </x-input.group>

                    <x-input.group label="Last Name" for="name" :error="$errors->first('last_name')">
                        <x-input.text wire:model.defer="last_name" id="last-name" />
                    </x-input.group>

                    <x-input.group label="Business Name" for="name" :error="$errors->first('business_name')">
                        <x-input.text wire:model.defer="business_name" id="business-name" />
                    </x-input.group>

                    <x-input.group label="Email" for="email" :error="$errors->first('email')">
                        <x-input.text wire:model.defer="email" id="email" />
                    </x-input.group>

                    <x-input.group label="Active?" for="active" :error="$errors->first('active')">
                        <x-input.checkbox wire:model.defer="active" id="active" />
                    </x-input.group>

                    <x-input.group label="Verified?" for="verified" :error="$errors->first('verified')">
                        <x-input.checkbox wire:model.defer="verified" id="verified" />
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

            @if (!empty($user) && $user->verificationImages->count() > 0)
                <h4 class="text-2xl font-semibold text-gray-900 mb-4">Verification Images</h4>

                <div class="overflow-y-auto">
                    <table
                        x-ref=""
                        class="items-center w-full bg-transparent border-collapse"
                    >
                        <thead>
                            <tr>
                                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Filename
                                </th>

                                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                    Uploaded
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->verificationImages as $file)
                                <tr
                                    class="cursor-pointer hover:bg-indigo-50"
                                >

                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        <i class="fa fa-download"></i> <a href="{{ $file->temporaryUrl() }}" title="{{ $file->original_filename }}">{{ $file->original_filename }}</a>
                                    </td>

                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
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
                                    Users
                                </h3>
                            </div>
                            <div class="relative w-full px-4 pr-0 max-w-full flex-grow flex-1 text-right">
                                <button
                                    wire:click="addUser()"
                                    @keydown.window.escape="open = false"
                                    class="bg-blue-500 text-white active:bg-blue-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                                    type="button"
                                >
                                    Add user
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
                                    <x-input.text wire:model.debounce.500ms="search" id="search" placeholder="Name or Email" />
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
                                            Account Type
                                        </th>

                                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Email
                                        </th>

                                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Status
                                        </th>

                                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Verified?
                                        </th>

                                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Registered
                                        </th>

                                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Profile
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr
                                            wire:click="setUser({{ $user->id }})"
                                            class="cursor-pointer hover:bg-indigo-50"
                                        >

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $user->name }}

                                                @if (!empty($user->business_name))
                                                    ({{ $user->business_name }})
                                                @endif
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $user->accountType() }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $user->email }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $user->trashed() ? 'Deleted' : 'Active' }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $user->is_verified ? 'Yes' : 'No' }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $user->created_at->format('d/m/Y H:i') }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                <a class="orange" href="{{ route('user.profile', [$user->getRouteKey(), $user->slug]) }}" target="_blank" title="View Profile">View Profile</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="my-4 px-2">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>

        </div>


    </div>
</div>
