<x-website.layout>

    <section class="login-page min-h-screen">

        <x-website.navbar />

        <div class="container mx-auto">
            <div class="row align-items-center">
                <div class="flex justify-center pt-36">
                    <div class="w-2/5 login-inner">
                        <form method="POST" action="{{ route('register') }}" class="bg-white shadow-md rounded-2xl mb-4 p-10">

                            @csrf

                            <h1 class="text-center font-semibold text-3xl uppercase">Create Account</h1>

                            <p class="text-base text-center font-semibold text-center pb-5 text-gray-400">
                                Signup to your account
                            </p>

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <div class="mb-4 lb-icon1 relative">
                                <i class="fas fa-user absolute top-3 left-3 orange text-lg"></i>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 border-gray-200 leading-tight focus:outline-none focus:shadow-outline pt-3 pb-3 pl-10"
                                       id="first_name"
                                       name="first_name"
                                       type="text"
                                       placeholder="{{ __('First Name') }}"
                                       required
                                       autofocus
                                       value="{{ old('first_name') }}"
                                />
                            </div>

                            <div class="mb-4 lb-icon1 relative">
                                <i class="fas fa-user absolute top-3 left-3 orange text-lg"></i>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 border-gray-200 leading-tight focus:outline-none focus:shadow-outline pt-3 pb-3 pl-10"
                                       id="last_name"
                                       name="last_name"
                                       type="text"
                                       placeholder="{{ __('Last Name') }}"
                                       autofocus
                                       value="{{ old('last_name') }}"
                                />
                            </div>

                            <div class="mb-4 lb-icon1 relative">
                                <i class="fas fa-envelope absolute top-3 left-3 orange text-lg"></i>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 border-gray-200 leading-tight focus:outline-none focus:shadow-outline pt-3 pb-3 pl-10"
                                       id="email"
                                       name="email"
                                       type="email"
                                       placeholder="{{ __('Email Address') }}"
                                       required
                                       value="{{ old('email') }}"
                                />
                            </div>

                            <div class="mb-6 lb-icon2 relative">
                                <i class="fas fa-lock absolute top-3 left-3 orange text-lg"></i>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 border-gray-200 leading-tight focus:outline-none focus:shadow-outline pl-10 pt-3 pb-3 pr-10"
                                       id="password"
                                       name="password"
                                       type="password"
                                       placeholder="{{ __('Password') }}"
                                       required
                                />

                                <i class="fas fa-eye-slash absolute right-5 top-4 text-gray-500"></i>
                            </div>

                            <div class="mb-6 lb-icon2 relative">
                                <i class="fas fa-lock absolute top-3 left-3 orange text-lg"></i>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 border-gray-200 leading-tight focus:outline-none focus:shadow-outline pl-10 pt-3 pb-3 pr-10"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       type="password"
                                       placeholder="{{ __('Confirm Password') }}"
                                       required
                                />
                            </div>

                            <div class="text-center pt-5">
                                <button class="blue-bg hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline text-lg mb-5 mt-5 pl-10 pr-10 uppercase" type="submit">
                                    {{ __('Sign up') }}
                                </button>

                                <br />
                                <p class="text-sm text-center font-semibold text-center pb-5 text-gray-400">
                                    Already have an account?
                                    <a href="{{ route('login') }}" class="orange font-semibold">{{ __('Log In') }}</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-website.layout>

