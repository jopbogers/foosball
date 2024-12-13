<?php

namespace Tests\Feature\Livewire;

use App\Livewire\AddMatch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AddMatchTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AddMatch::class)
            ->assertStatus(200);
    }
}
