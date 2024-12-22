<?php

namespace App\Livewire;

use App\Models\Season;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Admin extends Component
{
    public string $seasonName = '';

    public string $search = '';

    public function createSeason()
    {
        if (empty($this->seasonName)) {
            return;
        }

        Season::whereNull('end_date')->update(['end_date' => now()]);
        Season::create(['name' => $this->seasonName, 'start_date' => now()]);
        session()->flash('success', 'Season created.');
        $this->redirectRoute('ranking');
    }

    public function render()
    {
        return view('livewire.admin', ['users' => User::withTrashed()->where('name', 'like', "%$this->search%")->paginate(7)]);
    }
}
