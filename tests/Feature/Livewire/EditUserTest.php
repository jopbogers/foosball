<?php

namespace Tests\Feature\Livewire;

use App\Livewire\EditUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(EditUser::class)
            ->assertStatus(200);
    }
}
