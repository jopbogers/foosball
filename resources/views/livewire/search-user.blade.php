<div class="my-5 flex flex-col gap-3 relative">
    @if($user)
        <x-input-label>{{$label}}</x-input-label>
        <button wire:click="delete" class="h-[42px] w-full shadow group bg-gray-900/50 rounded-md flex justify-between items-center px-5">
            <p>{{$user->name}}</p>
            <x-carbon-close class="w-6 h-6 group-hover:text-red-500 duration-300" />
        </button>
    @else
    <x-dropdown>
        <x-slot name="trigger">
            <x-input-label>{{$label}}</x-input-label>
            <x-text-input wire:model.live="search" class="w-full mt-3" placeholder="Search..."></x-text-input>
        </x-slot>
        <div class="absolute z-50 mt-3  rounded-md bg-gray-700 w-full shadow-lg max-h-52 overflow-y-auto">
            @foreach($users as $user)
                <button wire:click="selectUser({{$user}})" class="w-full text-left p-3 bg-gray-900/80 border border-gray-700 hover:bg-gray-700">
                    <p>{{$user->name}}</p>
                </button>
            @endforeach
        </div>
    </x-dropdown>
    @endif
</div>
