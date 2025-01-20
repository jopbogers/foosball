<?php

namespace Tests\Feature\Livewire;

use App\Livewire\SearchUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SearchUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed')->run();
    }
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SearchUser::class)
            ->assertStatus(200);
    }
}
