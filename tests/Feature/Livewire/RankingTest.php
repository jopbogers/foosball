<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Ranking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RankingTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Ranking::class)
            ->assertStatus(200);
    }
}
