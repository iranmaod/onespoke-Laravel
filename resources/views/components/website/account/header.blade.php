<x-website.hero>
    <section id="banner-image-bg" class="pt-44 pb-44 relative bg-no-repeat bg-center bg-cover" style="background-image: url({{ empty(auth()->user()->bannerImage()) ? url('/images/s-bikebg.png') : auth()->user()->bannerImage()->url() }})">

        @if (request()->routeIs('website.account.profile'))
            <div class="hidden">
                <input type="file" id="banner-image" name="banner_image" accept="image/*" class="hidden"/>

                <label for="banner-image" class="cursor-pointer">
                    <div class="rounded-full border-2 border-blue-500 bg-white absolute py-1 px-2 top-4 right-24">
                        <i class="fa fa-pencil text-gray-600 text-2xl"></i>
                    </div>
                </label>
            </div>
        @endif

        <div class="container mx-auto">
            <div class="row">
                <div class="grid">
                    <!-- <a href="#!" class="absolute text-black px-3 py-2 rounded top-10 right-20 bg-gray-200"><i class="far fa-edit"></i></a> -->
                </div>
            </div>
        </div>
    </section>
</x-website.hero>

<section class="b-profile pb-10 relative">
    <div class="container mx-auto w-3/4">
        <div class="row">
            <div class="grid pt-40 md:pt-20 pb-10 md:pb-20">
                <div class="flex flex-wrap justify-center">
                    <div class="w-6/12 sm:w-4/12 px-4 relative">
                        <img src="{{ empty(auth()->user()->profileImage()) ? url('/images/empty-profile.png') : auth()->user()->profileImage()->url() }}" alt="{{ auth()->user()->name }}" class="profile-image rounded-full w-52 object-cover align-middle border-none mx-auto" />
                        @if (request()->routeIs('website.account.profile'))
                            <div>
                                <input type="file" id="profile-image" name="profile_photo" accept="image/*" class="hidden"/>

                                <label for="profile-image" class="cursor-pointer">
                                    <div class="rounded-full border-2 border-blue-500 bg-white absolute py-1 px-2 bottom-4 right-24">
                                        <i class="fa fa-camera text-gray-600 text-2xl"></i>
                                    </div>
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="text-center">

                    <div class="flex items-center justify-center">

                        <h2 class="user-name text-center text-2xl font-semibold">
                            {{ auth()->user()->displayName }}
                        </h2>

                        @if (auth()->user()->is_verified)
                            <button data-popper="dropdown-verified" class="orange-bg text-white rounded-full text-center w-6 h-6 inline-block mx-1 open-popper">
                                <i class="fa fa-check text-xs"></i>
                            </button>

                            <div
                                id="dropdown-verified"
                                class="hidden popper bg-white border-0 mb-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg"
                            >
                                <div>
                                    <div
                                        class="bg-white text-gray opacity-75 p-3 mb-0 border border-solid rounded"
                                    >
                                        This tick box indicates this user has uploaded at least one form of ID which matches the name on their account
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if (auth()->user()->account_type === App\Models\User::BUSINESS)
                        <p class="user-location pb-5">{{ auth()->user()->address }}</p>
                    @elseif (!empty($user->location))
                        <p class="user-location pb-5">{{ auth()->user()->location }}</p>
                    @endif

                    @if (!empty(auth()->user()->instagram))
                        <a href="https://instagram.com/{{ auth()->user()->instagram }}" class="text-xl px-3 text-gray-500"> <i class="fab fa-instagram"></i></a>
                    @endif

                    @if (!empty(auth()->user()->facebook))
                        <a href="https://facebook.com/{{ auth()->user()->facebook }}" class="text-xl px-3 text-gray-500"> <i class="fab fa-facebook-f"></i></a>
                    @endif

                    @if (!empty(auth()->user()->twitter))
                        <a href="https://twitter.com/{{ auth()->user()->twitter }}" class="text-xl px-3 text-gray-500"> <i class="fab fa-twitter"></i></a>
                    @endif

                    @if (!empty(auth()->user()->linkedin))
                        <a href="https://linkedin.com/{{ auth()->user()->linkedin }}" class="text-xl px-3 text-gray-500"> <i class="fab fa-linkedin-in"></i></a>
                    @endif

                    <p class="user-bio max-w-xl mx-auto pt-5 font-semibold">{{ auth()->user()->bio }}</p>

                </div>
            </div>

            <x-website.account.nav />
        </div>
    </div>
</section>

@if (request()->routeIs('website.account.profile'))
    <!-- profile picture modal -->
    <div
        class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-30"
        id="profile-picture-modal"
    >
        <div
            class="relative top-20 mx-auto p-5 border w-4/5 sm:w-4/5 md:w-3/5 lg:w-3/5 xl:w-2/5 shadow-lg rounded-md bg-white"
        >
            <div class="flex flex-row justify-between py-6 mx-3 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-bold text-lg text-gray-800">Crop Profile Image</p>
                <button class="x" type="button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="mt-5">

                <form method="post" action="{{ route('account.cropped-avatar.update') }}">

                    <div class="items-center text-center px-4 py-3 overflow-hidden">
                        <img id="profile-image-cropper" class="w-100 h-64">
                    </div>

                    <div class="items-center text-center px-4 py-3">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-400 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-200"
                        >
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- banner picture modal -->
    <div
        class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-30"
        id="banner-image-modal"
    >
        <div
            class="relative top-20 mx-auto p-5 border w-4/5 sm:w-4/5 md:w-3/5 lg:w-3/5 xl:w-2/5 shadow-lg rounded-md bg-white"
        >
            <div class="flex flex-row justify-between py-6 mx-3 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-bold text-lg text-gray-800">Crop Banner Image</p>
                <button class="x" type="button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="mt-5">

                <form method="post" action="{{ route('account.cropped-banner.update') }}">

                    <div class="items-center text-center px-4 py-3 overflow-hidden">
                        <img id="banner-image-cropper" class="w-100 h-64">
                    </div>

                    <div class="items-center text-center px-4 py-3">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-400 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-200"
                        >
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endif
