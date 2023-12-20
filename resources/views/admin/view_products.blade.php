<x-layouts.admin>
    {{-- <h2 class="text-center text-4xl font-bold pb-3 uppercase text-white"><span class="orange">Add Bike </h2> --}}
        <section class="soldbike-sec2 pb-4 md:pb-12">
            <div class="container mx-auto px-12">
                <div class="row">
                    <div class="grid pt-20 pb-20">
                        <h3 class="text-3xl font-bold text-center">VIEW <span class="orange"> PRODUCTS </span></h3>
                    </div>
                    <div class="listing-form">
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
                                        Price
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Category
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Stock
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Supplier
                                    </th>

                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Created At
                                    </th>
                                    <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Action
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Products::all() as $bike)
                                        <tr
                                            wire:click="setBike({{ $bike->id }})"
                                            class="cursor-pointer hover:bg-indigo-50"
                                        >

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                <a class="text-blue-600 hover:text-blue-500" href="#" target="_blank" title="View Bike">{{ $bike->name }}</a>
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $bike->price }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                <a class="text-blue-600 hover:text-blue-500" href="#" target="_blank" title="View Profile">{!!$bike->category->name!!}</a>
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{$bike->stock}}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {!!$bike->supplier->name!!}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $bike->created_at->format('d/m/Y H:i') }}
                                            </td>

                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                <a class="p-3" href="{{route('product.edit',$bike->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><button class="btn btn-primary">Edit</button></a>
                                                <a href="{{route('product.delete',$bike->id)}}"><button class="btn btn-danger"><i class="fa fa-trash"
                                                    aria-hidden="true"></i>Delete</button></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    
                    </div>
                </div>
            </div>
        </section>
</x-layouts.admin>

