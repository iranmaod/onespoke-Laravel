<x-layouts.admin>
    {{-- <h2 class="text-center text-4xl font-bold pb-3 uppercase text-white"><span class="orange">Add Bike </h2> --}}
        <section class="soldbike-sec2 pb-4 md:pb-12">
          

            <div class="container mx-auto px-12">
                <div class="row">
                    <div class="grid pt-20 pb-20">
                        <h3 class="text-3xl font-bold text-center">ADD NEW Supplier <span class="orange"> BIKE </span></h3>
                    </div>
                    <div class="listing-form">
                        <form action="{{route('work.supplier.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if (!empty($bike))
                                @method('put')
                            @endif
        
                            <div class="form-control flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="title">
                                        Name <span class="text-red-400">*</span>
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="title" name="contact_name" type="text" placeholder="Full Name"  required>
                                    <div class="error text-red-400"></div>
                                </div>
                            </div>
                            <div class="form-control flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="title">
                                        Email <span class="text-red-400">*</span>
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="title" name="email" type="email" placeholder="Email"  required>
                                    <div class="error text-red-400"></div>
                                </div>
                            </div>

                            <div class="form-control flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="title">
                                       Business/Warehouse Name <span class="text-red-400">*</span>
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="title" name="name" type="text" placeholder="Name"  required>
                                    <div class="error text-red-400"></div>
                                </div>
                            </div>
        
                        
        
                            <div class="relative">
                                <label>Country</label>

                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="country_id" name="country_id">
                                    <option value="">Select</option>

                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
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
</x-layouts.admin>

