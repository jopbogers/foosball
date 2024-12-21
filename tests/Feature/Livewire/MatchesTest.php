<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Matches;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MatchesTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Matches::class)
            ->assertStatus(200);
    }
}
