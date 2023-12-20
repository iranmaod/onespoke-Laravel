
@props([
    'disabled' => false,
    'inline' => false,
])

<div class="{{ $inline ? 'inline-flex' : 'flex' }} rounded-md">
    <input {{ $attributes }}
        {{ $disabled ? 'disabled' : '' }}
        type="checkbox"
        {{ $attributes->merge(['class' => 'form-checkbox border-cool-gray-300 block mt-2 ml-1 transition duration-150 ease-in-out sm:text-sm sm:leading-5' . ($disabled ? ' text-gray-400' : '')]) }}
    />
</div>
