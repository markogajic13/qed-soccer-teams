<?php

namespace Database\Factories;

use App\Models\League;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LeagueFactory extends Factory
{
    protected $model = League::class;

    public function definition() : array 
    {
        $leagues = [
            'Premier League',
            'La Liga',
            'Bundesliga',
            'Serie A',
            'Ligue 1',
            'Super League',
            'Premiership',
            'SuperSport',
            'First League',
            'First Division',
        ];
        return [
            'name' => fake()->unique()->randomElement($leagues),
            //'avatar' => fake()->imageUrl(200, 200),
        ];
    }
}