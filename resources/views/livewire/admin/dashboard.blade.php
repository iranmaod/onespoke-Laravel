
<div>
    <!-- Header -->
    <div class="relative bg-blue-600 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>

                <!-- Card stats -->
                <div class="flex flex-wrap">

                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-gray-500 uppercase font-bold text-xs">
                                            {{ Illuminate\Support\Str::plural('User', \App\Models\User::count()) }}
                                        </h5>
                                        <span class="font-semibold text-xl text-gray-800">
                                        {{ number_format(\App\Models\User::count()) }}
                                    </span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-400">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-4">
                                    <a href="{{ route('admin.users') }}" title="View Users">View Users</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-gray-500 uppercase font-bold text-xs">
                                            {{ Illuminate\Support\Str::plural('Bike', \App\Models\Bike::count()) }}
                                        </h5>
                                        <span class="font-semibold text-xl text-gray-800">
                                        {{ number_format(\App\Models\Bike::count()) }}
                                    </span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-400">
                                            <i class="fas fa-biking"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-4">
                                    <a href="#" title="View Bikes">&nbsp;</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-gray-500 uppercase font-bold text-xs">
                                            {{ Illuminate\Support\Str::plural('Manufacturer', \App\Models\Manufacturer::count()) }}
                                        </h5>
                                        <span class="font-semibold text-xl text-gray-800">
                                        {{ number_format(\App\Models\Manufacturer::count()) }}
                                    </span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-400">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-4">
                                    <a href="{{ route('admin.manufacturers') }}" title="View Machines">View Manufacturers</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
