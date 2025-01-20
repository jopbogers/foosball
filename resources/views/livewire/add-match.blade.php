<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-12 text-gray-100">
                <h1 class="text-center text-2xl font-semibold">Register Match</h1>
                <x-match-type/>
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="w-full">
                        <h2 class="text-3xl font-bold text-red-600 ">Team Red</h2>
                        <livewire:search-user event="player-red-1" label="User 1"/>
                        @if($matchType == '2v2')
                            <livewire:search-user event="player-red-2" label="User 2"/>
                        @endif
                        <div class="my-5 flex flex-col gap-3">
                            <x-input-label>Score</x-input-label>
                            <x-match-score team="Red"/>
                        </div>
                    </div>
                    <div class="w-full">
                        <h2 class="text-3xl font-bold text-blue-600 ">Team Blue</h2>
                        <livewire:search-user event="player-blue-1" label="User 1"/>
                        @if($matchType == '2v2')
                            <livewire:search-user event="player-blue-2" label="User 2"/>
                        @endif
                        <div class="my-5 flex flex-col gap-3">
                            <x-input-label>Score</x-input-label>
                            <x-match-score team="Blue"/>
                        </div>
                    </div>
                </div>
                <x-primary-button wire:click="save" :disabled="!$valid || $disabled"
                wire:loading.attr="disabled" class="w-full mt-5 !text-lg" wire:target="save">
                    Submit
                </x-primary-button>
            </div>
        </div>
    </div>
</div>
