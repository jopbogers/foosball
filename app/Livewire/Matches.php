<?php

namespace App\Livewire;

use App\Models\Season;
use Livewire\Component;

class Matches extends Component
{
    public Season $season;

    public function mount()
    {
        $this->season = Season::latest()->first();
    }

    public function render()
    {
        return view('livewire.matches', [
            'matches' => $this->season->matches()->orderBy('created_at', 'desc')->simplePaginate(4)
        ]);
    }
}
