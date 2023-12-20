<x-layouts.admin>
        {{-- <h2 class="text-center text-4xl font-bold pb-3 uppercase text-white"><span class="orange">Add Bike </h2> --}}
            <section class="soldbike-sec2 pb-4 md:pb-12">
                <div class="container mx-auto px-12">
                    <div class="row">
                        <div class="grid pt-20 pb-20">
                            <h3 class="text-3xl font-bold text-center">ADD NEW <span class="orange"> BIKE </span></h3>
                        </div>
                        <div class="listing-form">
                            <form id="new-listing-form" class="w-full md:w-3/4 mx-auto" action="{{ route('work.product.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (!empty($bike))
                                    @method('put')
                                @endif
            
                                <div class="form-control flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="title">
                                            Product Name <span class="text-red-400">*</span>
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="title" name="name" type="text" placeholder="The title of your listing" value="{{ $bike->title ?? '' }}" required>
                                        <div class="error text-red-400"></div>
                                    </div>
                                </div>

                                <div class="form-control flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="title">
                                            Assign Supplier <span class="text-red-400">*</span>
                                        </label>
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="supplier_id" name="supplier_id">
                                            <option value="">Select</option>
                                            @foreach (\App\Models\Supplier::all() as $manufacturer)
                                                <option value="{{ $manufacturer->id }}" {{ (!empty($bike) && $bike->manufacturer_id === $manufacturer->id) ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
                                            @endforeach
                                        </select>                                        <div class="error text-red-400"></div>
                                    </div>
                                </div>
            
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="form-control w-full px-3">
                                        <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="description">
                                            Description
                                        </label>
                                        <textarea rows="4" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="description" name="description" placeholder="More information about the bike (maximum 2,000 characters)" required>{{ $bike->description ?? '' }}</textarea>
                                        <div class="error text-red-400"></div>
                                    </div>
                                </div>
            
                              
                                
            
                                <div class="flex flex-wrap -mx-3 mb-12">
                                    <div class="form-control w-full px-3 mb-3">
                                        <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="model">
                                            Original Link
                                        </label>
                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="original_url" name="original_url" type="text" placeholder="original url">
                                        <div class="error text-red-400"></div>
                                    </div>
            
                                
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">

                                    <div class="form-control w-full md:w-1/2 px-3 mb-3">
                                        <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="year">
                                            Stock
                                        </label>
                                        <div class="relative">
                                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="stock" name="stock" type="number" placeholder="Add Stock" value="{{ $bike->stock ?? '' }}">
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

 
            
                                </div>
            

       

                                <div class="relative">
                                    <label>Category</label>
                                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="category_id" name="category_id">
                                        <option value="">Select</option>

                                        @foreach($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                        </svg>
                                    </div>
                                </div>
            
                                <h2 class="text-2xl font-bold">Photo</h2>
            
                                {{-- <p class="text-gray-500 my-3">
                                    To help your listing sell, we strongly recommend that you attach 4-10 high-resolution photos. The maximum file size is 10MB per image, with 6000x4000 maximum dimensions.
                                </p> --}}
            
                              
                                <div class="row">
                                    <label class="col-sm-4 col-lg-2 col-form-label">Featured image</label>
                                    <div class="col-sm-8 col-lg-10">
                                        <div class="input-group">
                                            <input id="image" class="form-control" name="image" required type="file" accept="image/*">
                                        </div>
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

