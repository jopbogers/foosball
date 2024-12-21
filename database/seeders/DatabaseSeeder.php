<?php

namespace Database\Seeders;

use App\Models\Season;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jop Bogers',
            'email' => 'jop.bogers@qlfbrands.com',
            'admin' => true,
        ]);

        Season::factory()->create();

         User::factory(10)->create();


    }
}
