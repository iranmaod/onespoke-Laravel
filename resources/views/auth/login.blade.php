<x-website.layout>

    <section class="login-page min-h-screen">

        <x-website.navbar />

        <div class="container mx-auto">
            <div class="row align-items-center">
                <div class="flex justify-center pt-36">
                    <div class="w-2/5 login-inner">
                        <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded-2xl mb-4 p-10">

                            @csrf

                            <h1 class="text-center font-semibold text-3xl uppercase">Login</h1>

                            <p class="text-base text-center font-semibold text-center pb-5 text-gray-400">
                                Login to your account
                            </p>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <div class="mb-4 lb-icon1 relative">
                                <i class="fas fa-envelope absolute top-3 left-3 orange text-lg"></i>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 border-gray-200 leading-tight focus:outline-none focus:shadow-outline pt-3 pb-3 pl-10"
                                       id="email"
                                       name="email"
                                       type="email"
                                       placeholder="Email Address"
                                       value="{{ old('email') }}"
                                       required
                                       autofocus
                                />
                            </div>

                            <div class="mb-6 lb-icon2 relative">
                                <i class="fas fa-lock absolute top-3 left-3 orange text-lg"></i>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 border-gray-200 leading-tight focus:outline-none focus:shadow-outline pl-10 pt-3 pb-3 pr-10"
                                       id="password"
                                       name="password"
                                       type="password"
                                       placeholder="Password"
                                       required
                                       autocomplete="current-password"
                                />

                                <i class="fas fa-eye-slash absolute right-5 top-4 text-gray-500"></i>
                            </div>

                            <label class="md:w-2/3 block text-gray-500">
                                <input id="remember_me" name="remember" class="mr-2 leading-tight" type="checkbox" />
                                <span class="text-base">{{ __('Remember me') }}</span>
                            </label>

                            <div class="text-center">
                                <button class="blue-bg hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline text-lg mb-5 mt-5 pl-10 pr-10 uppercase" type="submit">
                                    {{ __('Log in') }}
                                </button>

                                <br />

                                <a class="pt-5 text-sm text-center text-bold text-center pb-0 text-gray-600" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>

                                <p class="text-sm text-center text-bold text-center pb-5 text-gray-600">
                                    Don't have an account?
                                    <a href="{{ route('register') }}" class="orange font-semibold">{{ __('Signup Now') }}</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-website.layout>
