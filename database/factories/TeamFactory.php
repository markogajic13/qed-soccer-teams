<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TeamFactory extends Factory implements HasMedia
{
    use InteractsWithMedia;
    protected $model = Team::class;

    public function definition() : array
    {
        $soccer = ['Soccer', 'Football', 'Athletic', 'Sporting', 'Sport']; 
        $locations = ['National', 'Premier', 'Major', 'Regional', 'Metropolitan', 'Prime', 'Expert'];
        $modifiers = ['FC', 'SC', 'AC', 'United', 'City', 'Stars', 'Union'];
        
        $teamName = fake()->randomElement($soccer) . ' ' . fake()->randomElement($locations) . ' ' . fake()->randomElement($modifiers);
        return [
            'name' => $teamName,
            //'avatar' => fake()->imageUrl(200, 200),
        ];
    }
}