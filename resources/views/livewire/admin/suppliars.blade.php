<div x-data="{ open: @entangle('open') }">

    

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
                                    Suppliers
                                </h3>
                            </div>
                            <div class="relative w-full px-4 pr-0 max-w-full flex-grow flex-1 text-right">
                                <button
                                    class="bg-blue-500 text-white active:bg-blue-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                                    type="button"
                                > <a href="{{route('work.supplier.create')}}">Add Suppliers</a>
                                    
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
                                           Business Name
                                        </th>
                                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Email
                                        </th>
                                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Contact Name
                                        </th>
                                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Address
                                        </th>

                                        <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Status
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Supplier::all() as $item)
                                    
                                        <tr
                                            wire:click="setManufacturer({{ $item->id }})"
                                            class="cursor-pointer hover:bg-indigo-50"
                                        >

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $item->name }}
                                            </td>
                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $item->email }}
                                            </td>
                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $item->contact_name }}
                                            </td>
                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $item->address }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $item->active ? 'Active' : 'Deactive' }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="my-4 px-2">
                        {{-- {{ $item->links() }} --}}
                    </div>

                </div>
            </div>

        </div>


    </div>
</div>

