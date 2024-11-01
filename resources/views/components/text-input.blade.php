@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-700 bg-gray-900 text-gray-300 focus:border-yellow focus:ring-yellow rounded-md shadow-sm']) }}>
