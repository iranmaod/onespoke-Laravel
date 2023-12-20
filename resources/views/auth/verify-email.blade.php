<x-website.layout>

    <section class="login-page min-h-screen">

        <x-website.navbar />

        <div class="container mx-auto">
            <div class="row align-items-center">
                <div class="flex justify-center pt-36">
                    <div class="w-2/5 login-inner">

                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('verification.send') }}" class="bg-white shadow-md rounded-2xl mb-4 p-10">

                            @csrf

                            <div class="text-center">
                                <button class="blue-bg hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline text-lg mb-5 mt-5 pl-10 pr-10 uppercase" type="submit">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-website.layout>

