<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        Game::factory(5)
            ->afterCreating(function (Game $game){
                $host = User::inRandomOrder()->first();
                $game->players()->attach($host->id, ['role' => 'host', 'joined_at' => fake()->dateTime()]);
            })->create();
    }
}
