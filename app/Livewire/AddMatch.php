<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class AddMatch extends Component
{
    public string $matchType = '2v2';

    public ?User $playerRed1 = null;
    public ?User $playerRed2 = null;
    public ?User $playerBlue1 = null;
    public ?User $playerBlue2 = null;


    public function updatedMatchType()
    {
        $this->playerRed1 = null;
        $this->playerRed2 = null;
        $this->playerBlue1 = null;
        $this->playerBlue2 = null;
    }

    public function render()
    {
        return view('livewire.add-match');
    }
}
