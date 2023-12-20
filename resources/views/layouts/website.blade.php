<x-layouts.app>

    <!--
        <div class="w-full">
            <div class="text-center text-white font-bold px-6 py-4 border-0 rounded rounded-tl-none rounded-tr-none relative bg-green-400">
                <p>
                    {{ config('app.name') }} is free to use for Business and Individual use until April 30th
                </p>
            </div>
        </div>
    -->

    <div class="website bg-white">
        {{ $slot }}
    </div>
</x-layouts.app>
