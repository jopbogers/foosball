@props(['disabled' => false])

<button @if($disabled) disabled @endif {{ $attributes->merge(['type' => 'submit', 'class' => 'items-center px-4 py-2 bg-yellow border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 disabled:bg-gray-700 focus:bg-gray-400 active:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
