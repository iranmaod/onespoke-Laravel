<div
    x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
    class="fixed overflow-x-scroll p-5 min-h-screen inset-y-0 right-0 z-10 pin-y bg-gray-50 shadow-md w-full sm:w-3/4 lg:w-1/2"
>

    <button
        type="button"
        @click="open = !open"
        class="float-right p-5 py-2 px-4"
    >
        <i class="fas fa-times"></i>
    </button>

    {{ $slot }}

</div>
