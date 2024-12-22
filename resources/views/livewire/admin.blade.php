<div class="py-10">
    <h1 class="text-gray-300 text-center text-3xl mb-10">User Management</h1>
    <div
        class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-gray-800 p-5 flex flex-col gap-5 overflow-hidden shadow-sm sm:rounded-lg text-gray-300">
        <x-text-input wire:model.live="search" placeholder="Search..."/>
        @foreach($users as $user)
            <a href="{{route('edit.user', ['userId' => $user])}}" class="bg-gray-900 p-3 rounded-lg grid grid-cols-3 justify-between">
                <h3>{{$user->name}}</h3>
                @if($user->deleted_at == null)
                    <p class="mx-auto text-green-700">active</p>
                @else
                    <p class="mx-auto text-red-700">inactive</p>
                @endif
                <x-carbon-edit class="w-5 h-5 ml-auto"/>
            </a>
        @endforeach
        {{$users->links()}}
    </div>
    <h1 class="text-gray-300 text-center text-3xl my-10">Create new Season</h1>
    <div
        class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-gray-800 p-5 flex flex-col gap-5 overflow-hidden shadow-sm sm:rounded-lg text-gray-300">
        <x-input-label>Season Name</x-input-label>
        <x-text-input wire:model.blur="seasonName"/>
        <x-primary-button wire:click="createSeason" wire:confirm="Are you sure you want to create a new season?">Create
        </x-primary-button>
    </div>
</div>
