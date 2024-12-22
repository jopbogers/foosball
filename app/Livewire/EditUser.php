<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public User $user;
    public string $name;
    public string $email;
    public bool $emailVerified;
    public bool $active;

    public function mount(int $userId): void
    {
        $this->user = User::withTrashed()->findOrFail($userId);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->emailVerified = !empty($this->user->email_verified_at);
        $this->active = empty($this->user->deleted_at);
    }

    public function updatedName()
    {
        $this->user->update(['name' => $this->name]);
    }

    public function updatedEmail()
    {
        $this->user->update(['email' => $this->email]);
    }

    public function updatedEmailVerified(): void
    {
        if ($this->emailVerified) {
            $this->user->markEmailAsVerified();
        } else {
            $this->user->update(['email_verified_at' => null]);
        }
    }

    public function updatedActive(): void
    {
        if ($this->active) {
            $this->user->restore();
        } else {
            $this->user->delete();
        }
    }


    public function render()
    {
        return view('livewire.edit-user');
    }
}
