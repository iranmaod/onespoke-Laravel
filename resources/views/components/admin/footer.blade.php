<footer class="block py-4">
    <div class="mx-auto px-4">
        <hr class="mb-4 border-b-1 border-gray-300">
        <div class="flex flex-wrap items-center md:justify-between justify-center">
            <div class="w-full md:w-4/12 px-4">
                <div class="text-sm text-gray-600 font-semibold py-1 text-center md:text-left">
                    Copyright © <span id="get-current-year">{{ now()->year }}</span>
                    <a href="https://www.onespoke.co.uk" class="text-gray-600 hover:text-gray-800 text-sm font-semibold py-1">
                        {{ config('app.name') }}
                    </a>
                </div>
            </div>
            <div class="w-full md:w-8/12 px-4">
                <ul class="flex flex-wrap list-none md:justify-end justify-center">
                    <li>
                        <a href="https://www.onespoke.co.uk" class="text-gray-700 hover:text-gray-900 text-sm font-semibold block py-1 px-3">
                            onespoke.co.uk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
