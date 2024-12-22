<?php

namespace Tests\Feature\Livewire;

use App\Livewire\EditMatch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditMatchTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(EditMatch::class)
            ->assertStatus(200);
    }
}
