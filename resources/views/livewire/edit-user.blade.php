<div class="py-10">
    <div
        class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-gray-800 p-5 flex flex-col gap-5 overflow-hidden shadow-sm sm:rounded-lg text-gray-300">
        <x-input-label>Name</x-input-label>
        <x-text-input wire:model.blur="name"/>
        <x-input-label>Email</x-input-label>
        <x-text-input wire:model.blur="email"/>
        <label for="emailVerified" class="inline-flex items-center">
            <input id="emailVerified" type="checkbox" wire:model.live="emailVerified" class="rounded bg-gray-900 border-gray-700 text-yellow shadow-sm focus:ring-yellow focus:ring-offset-gray-800" name="emailVerified">
            <span class="ms-2 text-gray-300">Email Verified</span>
        </label>
        <label for="active" class="inline-flex items-center">
            <input id="active" type="checkbox" wire:model.live="active" class="rounded bg-gray-900 border-gray-700 text-yellow shadow-sm focus:ring-yellow focus:ring-offset-gray-800" name="active">
            <span class="ms-2 text-gray-300">Active</span>
        </label>
    </div>
</div>
