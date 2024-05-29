<?php

namespace Database\Seeders;

use App\Jobs\ImportAvatars;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Player;
use App\Models\League;
use Faker\Factory as Faker;

class LTPSeeder extends Seeder
{
    public function run(): void
    {
        $numberOfLeagues = 10;
        $teamsPerLeague = 15;
        $faker = Faker::create();

        $allLeagues = [];
        $allTeams = [];
        $allPlayers = [];

        $leagues = League::factory()->count($numberOfLeagues)->make()->toArray();
        $allLeagues = array_merge($allLeagues, $leagues);
        
        foreach ($leagues as $leagueIndex => $league) {
            $teams = Team::factory()->count($teamsPerLeague)->make(['league_id' => $leagueIndex + 1])->toArray();
            $allTeams = array_merge($allTeams, $teams);
        }

        foreach ($allTeams as $teamIndex => $team) {
            $players = Player::factory()->count(22)->make(['team_id' => $teamIndex + 1])->toArray();
            $allPlayers = array_merge($allPlayers, $players);
        }

        $count = collect($allPlayers)->filter(fn($p) => $p['team_id'] == 7)->count();
        \Log::info('Total by team_id 7: ', [$count]);

        League::insert($allLeagues);
        Team::insert($allTeams);
        Player::insert($allPlayers);

        ImportAvatars::dispatch('leagues');
        ImportAvatars::dispatch('teams');
        ImportAvatars::dispatch('players');
    }
}