<x-website.layout>

    <x-website.navbar />

    <x-website.hero>
        <section class="sold-bike1 pt-44 pb-44 relative">
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
                <div class="grid pt-20 pb-20">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-6/12 sm:w-4/12 px-4">
                            <img src="{{ empty($user->profileImage()) ? url('/images/empty-profile.png') : $user->profileImage()->url() }}" alt="{{ $user->displayName }}" class="profile-image rounded-full h-52 w-52 h-auto align-middle border-none mx-auto" />
                        </div>
                    </div>

                    <div class="text-center">

                        <div class="flex items-center justify-center">

                            <h2 class="user-name text-center text-2xl font-semibold">
                                {{ $user->displayName }}
                            </h2>

                            @if ($user->is_verified)
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

                        <p class="pb-5">{{ $user->accountType() }} Account</p>

                        @auth
                            @if ($user->id !== request()->user()->id)
                                <button id="message-user" class="orange-btn px-5 text-center text-xs rounded-xl font-semibold my-3 py-3 hover:bg-gray-500 hover:text-white">
                                    Message {{ $user->displayName }}
                                </button>
                            @endif
                        @endauth

                        @guest
                            <button id="message-user" class="orange-btn px-5 text-center text-xs rounded-xl font-semibold my-3 py-3 hover:bg-gray-500 hover:text-white" disabled>
                                Log in to Message {{ $user->displayName }}
                            </button>
                        @endguest

                        @if ($user->account_type === App\Models\User::BUSINESS)
                            <p class="user-location pb-5">{!! nl2br(e($user->address), false) !!}</p>
                        @elseif (!empty($user->location))
                            <p class="user-location pb-5">{{ $user->location }}</p>
                        @endif

                        @if (!empty($user->instagram))
                            <a href="https://instagram.com/{{ $user->instagram }}" class="text-xl px-3 text-gray-500"> <i class="fab fa-instagram"></i></a>
                        @endif

                        @if (!empty($user->facebook))
                            <a href="https://facebook.com/{{ $user->facebook }}" class="text-xl px-3 text-gray-500"> <i class="fab fa-facebook-f"></i></a>
                        @endif

                        @if (!empty(auth()->user()->twitter))
                            <a href="https://twitter.com/{{ $user->twitter }}" class="text-xl px-3 text-gray-500"> <i class="fab fa-twitter"></i></a>
                        @endif

                        @if (!empty(auth()->user()->linkedin))
                            <a href="https://linkedin.com/{{ $user->linkedin }}" class="text-xl px-3 text-gray-500"> <i class="fab fa-linkedin-in"></i></a>
                        @endif

                        <p class="user-bio max-w-xl mx-auto pt-5 font-semibold">{{ $user->bio }}</p>

                    </div>
                </div>


            </div>
        </div>
    </section>

    @auth
        @if ($user->id === request()->user()->id)
            <div class="grid w-9/12 mx-auto pb-5">
                <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-300">
                    <span class="text-xl inline-block mr-5 align-middle">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="inline-block align-middle mr-8">
                        This is your public profile
                    </span>
                </div>
            </div>
        @endif
    @endauth

    <section class="card-section pb-20 vb_profile">
        <div class="row">
            <div class="container mx-auto">
                <div class="grid col-1 pb-14">
                    <div class=vb-family>
                        <h2 class="text-4xl font-semibold text-center dark w-3/4 mx-auto">All Listed Bikes</h2>
                    </div>
                </div>


                <div id="listings" class="flex flex-wrap justify-center featured-bikes w-11/12 mx-auto media-block">

                </div>
            </div>
        </div>
    </section>

    <x-website.footer />

    <!-- modal -->
    <div
        class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
        id="message-user-modal"
    >
        <div
            class="relative top-20 mx-auto p-5 border w-4/5 sm:w-4/5 md:w-3/5 lg:w-3/5 xl:w-2/5 shadow-lg rounded-md bg-white"
        >
            <div class="flex flex-row justify-between py-6 mx-3 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                <p class="font-bold text-lg text-gray-800">Message {{ $user->displayName }}</p>
                <button id="x" type="button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="mt-5">

                <form method="post" action="{{ route('user.message', [$user, $user->slug]) }}">

                    <div class="form-control w-full px-3">
                        <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="message">
                            Message
                        </label>
                        <textarea rows="4" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="message" name="message" placeholder="Could you give me more information about the bike?"></textarea>
                        <div class="error text-red-400"></div>
                    </div>

                    <div class="items-center text-center px-4 py-3">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-400 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-200"
                        >
                            Send
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    @push('body')
        user.profile
    @endpush

    @push('scripts')
        <script>
            var listingsUrl = '{{ route('user-listings.index', [$user, $user->slug]) }}';
        </script>
        <script src="{{ mix('js/user/profile.js') }}"></script>
    @endpush

</x-website.layout>
