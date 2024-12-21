@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex h-min my-auto bg-gray-300 items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-yellow focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150'
                : 'inline-flex h-min my-auto bg-yellow items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-yellow focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

