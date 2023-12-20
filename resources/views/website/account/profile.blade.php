<x-website.layout>

    <x-website.navbar />

    <x-website.account.header />

    <section class="soldbike-sec2 pb-20">
        <div class="container mx-auto w-3/4">
            <div class="row">
                <div class="listing-form">
                    <form id="profile-form" class="w-3/4 mx-auto" action="{{ route('account.profile.update') }}" method="post">
                        
                        <div class="grid pt-1 pb-10">
                            <h3 class="text-3xl font-bold uppercase f-arial">User Details</h3>
                        </div>

                        <div class="flex">
                            <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="account-type-personal">
                                Account Type <span class="text-red-400">*</span>
                            </label>
                        </div>

                        <div class="flex -mx-3">
                            <div class="px-3 pb-8 flex flex-wrap items-center">
                                <input type="radio" id="account-type-personal" name="account_type" class="pl-2" value="{{ App\Models\User::PERSONAL }}" {{ auth()->user()->account_type === App\Models\User::PERSONAL ? 'checked' : '' }}>
                                <label for="account-type-personal" class="pl-4">Personal Account</label>
                            </div>
                            <div class=" pl-5 pb-8 flex flex-wrap items-center">
                                <input type="radio" id="account-type-business" name="account_type" class="text-lg" value="{{ App\Models\User::BUSINESS }}" {{ auth()->user()->account_type === App\Models\User::BUSINESS ? 'checked' : '' }}>
                                <label for="account-type-business" class="pl-4">Business Account</label>
                            </div>
                        </div>

                        <div class="business-inputs {{ auth()->user()->account_type === App\Models\User::PERSONAL ? 'hidden' : '' }}">
                            <div class="flex flex-wrap -mx-3 mb-6">

                                <div class="w-full w-full px-3">
                                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="business-name">
                                        Business Name <span class="text-red-400">*</span>
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="business-name" name="business_name" type="text" placeholder="Business name" value="{{ auth()->user()->business_name }}">
                                    <div class="error text-red-400"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="first-name">
                                    First Name <span class="text-red-400">*</span>
                                </label>
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="first-name" name="first_name" type="text" placeholder="First name" value="{{ auth()->user()->first_name }}">
                                <div class="error text-red-400"></div>
                            </div>

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="last-name">
                                    Last Name
                                </label>
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="last-name" name="last_name" type="text" placeholder="Last name" value="{{ auth()->user()->last_name }}">
                                <div class="error text-red-400"></div>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                    Email <span class="text-red-400">*</span>
                                    <br>
                                    <span class="text-xs font-normal">&nbsp;</span>
                                </label>
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" name="email" type="email" placeholder="Email" value="{{ auth()->user()->email }}">
                                <div class="error text-red-400"></div>
                            </div>

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                    Phone<br><span class="text-xs font-normal">(if you enter a contact number, it will be publicly displayed on your adverts)</span>
                                </label>
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="phone" name="phone" type="text" placeholder="Phone" value="{{ auth()->user()->phone }}">
                                <div class="error text-red-400"></div>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 pb-3">
                                <p class="text-base font-semibold uppercase">Address</p>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address-1" name="address_1" type="text" placeholder="Address line 1" value="{{ auth()->user()->address_1 }}">
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="city" name="city" type="text" placeholder="City" value="{{ auth()->user()->city }}">
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="country" name="country" type="text" placeholder="Country" value="{{ auth()->user()->country }}">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address-2" name="address_2" type="text" placeholder="Address line 2" value="{{ auth()->user()->address_2 }}">
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="county" name="county" type="text" placeholder="County" value="{{ auth()->user()->county }}">
                                <input class="appearance-none block w-2/3 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="postcode" name="postcode" type="text" placeholder="Post Code" value="{{ auth()->user()->postcode }}">
                            </div>
                        </div>

                        @if (!auth()->user()->is_verified)
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <h2 class="text-2xl font-semibold f-arial">ID Verification</h2>
                                    <p class="text-gray-500 mt-3">Please note: Uploading your ID will notify a member of our team who will manually verify your account with a blue tick marked on your profile. This measure is in place to increase buyer trust that any seller is genuine.</p>
                                    <p class="text-gray-500 mt-3">Uploading your ID is optional and will be securely stored within our backend servers and will not be attainable to customers under any circumstances.</p>

                                    @if (auth()->user()->verificationImages->count() > 0)
                                        <p class="my-3 font-bold orange">
                                            You have uploaded {{ auth()->user()->verificationImages->count() }} verification {{ Illuminate\Support\Str::plural('document', auth()->user()->verificationImages->count()) }} for our review.
                                        </p>
                                    @endif

                                    <div class="my-5">
                                        <div class="form-control w-full">
                                            <label class="block tracking-wide text-gray-700 text-base font-bold mb-2" for="wheel_size_id">

                                            </label>

                                            <div class="error text-red-400"></div>

                                            <input
                                                id="images"
                                                type="file"
                                                class="filepond"
                                                name="verification_images[]"
                                                multiple
                                                data-allow-reorder="true"
                                                data-max-file-size="10MB"
                                                data-max-files="10"
                                                accept="image/png, image/jpeg, image/gif"
                                                data-label-idle="Drag & Drop your verification images or <span class='filepond--label-action'> Browse </span>"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <h2 class="text-2xl font-semibold f-arial">ID Verification</h2>

                                    <div class="grid w-full mx-auto pb-5 mt-6">
                                        <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-300">
                                            <span class="text-xl inline-block mr-5 align-middle">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            <span class="inline-block align-middle mr-8">
                                                Your account has been verified
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!--<div class="flex flex-wrap -mx-3 mb-6">-->
                        <!--   <div class="w-full md:w-1/2 px-3">-->
                        <!--      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-text">-->
                        <!--      Company House Registration Number-->
                        <!--      </label>-->
                        <!--      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-text" type="text" placeholder="12345">-->
                        <!--   </div>-->
                        <!--</div> -->
                        <!--<div class="flex flex-wrap -mx-3 mb-6">-->
                        <!--   <div class="w-full md:w-1/2 px-3">-->
                        <!--      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-text">-->
                        <!--      Company House Registration Number-->
                        <!--      </label>-->
                        <!--      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-text" type="text" placeholder="12345">-->
                        <!--   </div>-->
                        <!--</div>-->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="bio">
                                    Short Bio <span class="font-normal">(max 240 characters)</span>
                                </label>
                                <textarea maxlength="240" class="border rounded-md w-full h-36 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Bio" name="bio">{{ auth()->user()->bio }}</textarea>
                                <div class="bio-count"></div>
                                <div class="error text-red-400"></div>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6 space-y-6">
                            <div class="w-full px-3">
                                <h2 class="text-2xl font-semibold f-arial pt-5 pb-2">Social Accounts</h2>
                            </div>

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="facebook">
                                    Facebook
                                </label>
                                <span class="z-10 leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                                    <i class="fab fa-facebook-f fb-color"></i>
                                </span>
                                <input type="text" id="facebook" name="facebook" value="{{ auth()->user()->facebook }}" placeholder="Facebook" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-2/3 pl-10"/>
                                <div class="error text-red-400"></div>
                            </div>

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="twitter">
                                    Twitter
                                </label>
                                <span class="z-10 leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                                    <i class="fab fa-twitter tw-color"></i>
                                </span>
                                <input id="twitter" type="text" name="twitter" value="{{ auth()->user()->twitter }}" placeholder="Twitter" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-2/3 pl-10"/>
                                <div class="error text-red-400"></div>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mt-5">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="instagram">
                                    Instagram
                                </label>
                                <span class="z-10 leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                                    <i class="fab fa-instagram insta-color"></i>
                                </span>
                                <input id="instagram" type="text" name="instagram" value="{{ auth()->user()->instagram }}" placeholder="Instagram" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-2/3 pl-10"/>
                                <div class="error text-red-400"></div>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mt-5">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="instagram">
                                    LinkedIn
                                </label>
                                <span class="z-10 leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                                    <i class="fab fa-linkedin linkedin-color"></i>
                                </span>
                                <input id="linkedin" type="text" name="linkedin" value="{{ auth()->user()->linkedin }}" placeholder="LinkedIn" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-2/3 pl-10"/>
                                <div class="error text-red-400"></div>
                            </div>
                        </div>

                        <div class="fixed bottom-20 right-5">
                            <button type="submit" class="text-xs blue-bg py-3 px-2 text-white text-center rounded-xl mt-5 shadow-2xl uppercase border border-white">
                                Update Profile
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <x-website.footer />

    @push('body')
        account.profile
    @endpush

    @push('scripts')
        <script src="/js/account/profile.js"></script>
    @endpush

</x-website.layout>
