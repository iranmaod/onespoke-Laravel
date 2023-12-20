
@props([
    'leadingAddOn' => false,
    'width' => 'w-full'
])

<div class="flex rounded-md shadow-sm">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {{ $leadingAddOn }}
        </span>
    @endif

    <input autocomplete="off" {{ $attributes->merge(['class' => $width . ' rounded-l-none rounded-md block pl-3 pr-10 py-2 text-base leading-6 border border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5 transition duration-150 ease-in-out' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')]) }}/>
</div>
