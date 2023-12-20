<x-website.layout>

    <section class="login-page min-h-screen">

        <x-website.navbar />

        <div class="container mx-auto">
            <div class="row align-items-center">
                <div class="flex justify-center pt-36">
                    <div class="w-2/5 login-inner">
                        <form method="POST" action="{{ route('password.confirm') }}" class="bg-white shadow-md rounded-2xl mb-4 p-10">

                        @csrf

                        <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <h1 class="text-center font-semibold text-3xl uppercase">Confirm Password</h1>

                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />


                            <div class="mb-6 lb-icon2 relative">
                                <i class="fas fa-lock absolute top-3 left-3 orange text-lg"></i>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 border-gray-200 leading-tight focus:outline-none focus:shadow-outline pl-10 pt-3 pb-3 pr-10"
                                       id="password"
                                       name="password"
                                       type="password"
                                       placeholder="{{ __('Password') }}"
                                       autocomplete="current-password"
                                       required
                                />

                                <i class="fas fa-eye-slash absolute right-5 top-4 text-gray-500"></i>
                            </div>


                            <div class="text-center pt-5">
                                <button class="blue-bg hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline text-lg mb-5 mt-5 pl-10 pr-10 uppercase" type="submit">
                                    {{ __('Confirm') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-website.layout>

