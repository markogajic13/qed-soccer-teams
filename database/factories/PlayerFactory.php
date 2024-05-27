<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition() : array
    {
        return [
            'name' => fake()->name(),
            //'avatar' => fake()->imageUrl(200, 200),
            'birthday' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'email' => fake()->unique()->email(), 
            'phone' => fake()->phoneNumber(),
            'performance_score' => fake()->numberBetween(0, 100), 
            'overall_score' => fake()->numberBetween(0, 100,), 
        ];
    }
}