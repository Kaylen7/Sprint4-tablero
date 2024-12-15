<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Events\FriendRequestSent;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->afterCreating(function (User $user){
            try{
                $friend = User::inRandomOrder()->first();
                $user->addFriend($friend);
                FriendRequestSent::dispatch($user, $friend);
            } catch(\Exception $e){
            };
            
        })->create();
        User::factory()->afterCreating(function (User $user){
            $friend = User::find(1);
            $user->addFriend($friend);
            FriendRequestSent::dispatch($user, $friend);
        })->create([
            'name' => 'test',
            'alias' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('password1234')
        ]);
        Game::factory(5)
            ->afterCreating(function (Game $game){
                $host = User::inRandomOrder()->first();
                $game->players()->attach($host->id, ['role' => 'host', 'joined_at' => fake()->dateTime()]);
            })->create();
        
    }
}
