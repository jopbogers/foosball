<?php

namespace App\Livewire;

use App\Models\Season;
use Livewire\Component;

class Ranking extends Component
{
    public Season $season;

    public function mount()
    {
        $this->season = Season::latest()->first();
    }

    public function render()
    {
        return view('livewire.ranking');
    }
}
