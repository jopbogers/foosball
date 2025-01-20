<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="bg-gray-800 overflow-hidden relative shadow-sm sm:rounded-lg">
            <div class="p-12 text-gray-100">
                <h1 class="text-center text-2xl font-semibold mb-10">Edit Match</h1>
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="w-full">
                        <h2 class="text-3xl font-bold text-red-600 ">Team Red</h2>
                        <livewire:search-user event="player-red-1" :user="$playerRed1" label="User 1"/>
                        @if($matchType == '2v2')
                            <livewire:search-user event="player-red-2" :user="$playerRed2" label="User 2"/>
                        @endif
                        <div class="my-5 flex flex-col gap-3">
                            <x-input-label>Score</x-input-label>
                            <x-match-score team="Red"/>
                        </div>
                    </div>
                    <div class="w-full">
                        <h2 class="text-3xl font-bold text-blue-600 ">Team Blue</h2>
                        <livewire:search-user event="player-blue-1" :user="$playerBlue1" label="User 1"/>
                        @if($matchType == '2v2')
                            <livewire:search-user event="player-blue-2" :user="$playerBlue2" label="User 2"/>
                        @endif
                        <div class="my-5 flex flex-col gap-3">
                            <x-input-label>Score</x-input-label>
                            <x-match-score team="Blue"/>
                        </div>
                    </div>
                </div>
                <x-primary-button wire:click="save" :disabled="!$valid || $disabled"
                                  wire:loading.attr="disabled" class="w-full mt-5 !text-lg" wire:target="save">
                    Update
                </x-primary-button>
                <button type="button" class="absolute top-5 right-5"
                        wire:loading.attr="disabled"
                        wire:target="delete"
                        wire:click="delete"
                        wire:confirm="Are you sure you want to delete this match?">
                    <x-carbon-trash-can class="w-6 h-6 text-red-500 hover:text-red-400 duration-300" />
                </button>
            </div>
        </div>
    </div>
</div>
