
<div
    class="rounded-md shadow-sm"
    x-data="{
        value: @entangle($attributes->wire('model')),
    }"
    x-on:trix-change="value = $event.target.value"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore
>
    <input id="x" type="hidden">
    <trix-editor x-ref="trix" input="x" wire-key="rich-text-{{ $attributes['id'] }}" class="form-textarea block bg-white w-full border-gray-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"></trix-editor>
</div>
