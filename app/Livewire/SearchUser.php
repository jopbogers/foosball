<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class SearchUser extends Component
{
    public string $label;
    public string $event;

    public string $search = '';
    public ?User $user;

    public function selectUser(User $user): void
    {
        $this->user = $user;
        $this->dispatch('set-'.$this->event, $user);
    }

    public function delete(): void
    {
        $this->user = null;
        $this->dispatch('delete-'.$this->event);
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.search-user', [
            'users' => User::where('name', 'like', "%$this->search%")->get()
        ]);
    }
}
