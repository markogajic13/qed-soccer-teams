<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Player;

class TeamsAndPlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Team::factory()->count(5)->create()->each(function ($team) {
            \App\Models\Player::factory()->count(10)->create(['team_id' => $team->id]);
        });
    }
}
