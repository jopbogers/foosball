<?php

namespace App\Livewire;

use Livewire\Component;

class SearchUser extends Component
{
    public string $label;

    public function mount(string $label)
    {
        $this->label = $label;
    }
    public function render()
    {
        return view('livewire.search-user');
    }
}
