<x-website.layout>

    <section class="login-page min-h-screen">

        <x-website.navbar />

        <div class="container mx-auto">
            <div class="row align-items-center">
                <div class="flex justify-center pt-36">
                    <div class="w-2/5 login-inner">
                        <form method="POST" action="{{ route('password.email') }}" class="bg-white shadow-md rounded-2xl mb-4 p-10">

                            @csrf

                            <h1 class="text-center font-semibold text-3xl uppercase">Password Reset</h1>

                            <p class="text-base text-center font-semibold text-center pb-5 text-gray-400">
                               Enter your email address and we will send you a password reset link
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

                            <div class="text-center">
                                <button class="blue-bg hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline text-lg mb-5 mt-5 pl-10 pr-10 uppercase" type="submit">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-website.layout>

