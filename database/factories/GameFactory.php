<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gameNames = ['Carcassone', 'Catán', 'Dixit', 'Exploding Kittens', '7 Wonders', 'Omerta'];

        return [
            'name' => fake()->words($nb = 3, $asText = true) ,
            'is_private' => fake()->boolean(),
            'max_players' => fake()->numberBetween(1, 5),
            'event_time' => fake()->dateTimeThisYear(),
            'address' => fake()->address(),
            'boardgame_name' => $gameNames[array_rand($gameNames)]
        ];
    }
}
