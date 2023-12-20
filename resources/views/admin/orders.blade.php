
<x-layouts.admin>
    {{-- <h2 class="text-center text-4xl font-bold pb-3 uppercase text-white"><span class="orange">Add Bike </h2> --}}
        <section class="soldbike-sec2 pb-4 md:pb-12">
            <div class="container mx-auto px-12">
                <div class="row">
                    <div class="grid pt-20 pb-20">
                        <h3 class="text-3xl font-bold text-center">All <span class="orange"> Orders </span></h3>
                    </div>
                   
                </div>
            </div>
        </section>
        <section class="card-section pb-20">
            <div class="row">
        
                <div class="w-full px-8 mx-auto h-screen">
                   
                    <div class="overflow-y-auto">
                        <table
                            x-ref=""
                            class="items-center w-full bg-transparent border-collapse"
                        >
                            <thead>
                            <tr>
        
                                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                   Invoice Number
                                </th>
        
                                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                   Total Amount
                                </th>
        
                                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Payment Method
                                </th>
        
                                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Date
                                </th>
        
        
                            </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\Invoice::all() as $item)
                                    <tr
                                        wire:click="setBike"
                                        class="cursor-pointer hover:bg-indigo-50 bg"
                                    >
        
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            <a class="text-blue-600 hover:text-blue-500" href="#" target="_blank" title="View Bike">{{$item->invoice_number }}</a>
                                        </td>
        
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            ${{$item->total_amount_with_tax}}
                                        </td>
        
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            {{$item->payment_method}}
                                        </td>
        
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            {{$item->created_at}}
                                        </td>
        
                                        
        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
        
                </div>
            </div>
        </section>
</x-layouts.admin>

