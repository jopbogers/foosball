@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-yellow text-start text-base font-medium text-gray-300 bg-gray-700/70 focus:outline-none focus:text-gray-200 focus:bg-gray-800 focus:border-gray-600 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-400 hover:text-gray-200 hover:bg-gray-700 hover:border-gray-600 focus:outline-none focus:text-gray-200 focus:bg-gray-700 focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
