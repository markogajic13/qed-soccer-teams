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

        $allLeagues=[];
        $allTeams=[];
        $allPlayers=[];

        $leagues = League::factory()->count($numberOfLeagues)->make()->toArray();
        $allLeagues = array_merge($allLeagues, $leagues);
        foreach ($leagues as $leagueIndex => $league) {
            $teams=Team::factory()->count($teamsPerLeague)->make(['league_id' => $leagueIndex + 1])->toArray();
            $allTeams = array_merge($allTeams, $teams);
            foreach ($teams as $teamIndex => $team) {
                $players = Player::factory()->count(22)->make( ['team_id' => $teamIndex + 1])->toArray();
                $allPlayers = array_merge($allPlayers, $players);
        }}

        League::insert($allLeagues);
        Team::insert($allTeams);
        Player::insert($allPlayers);

        ImportAvatars::dispatch('leagues');
        ImportAvatars::dispatch('teams');
        ImportAvatars::dispatch('players');

        /*$leagues = League::factory()->count($numberOfLeagues)->create();
        foreach ($leagues as $league) {
            Team::factory()->count($teamsPerLeague)->create(['league_id' => $league->id])->each(function ($team) use ($faker, $league) {
                $teamImageUrl = $faker->imageUrl(200, 200);
                $team->addMediaFromUrl($teamImageUrl)->toMediaCollection('avatars');
                $leagueImageUrl = $faker->imageUrl(200, 200);
                $league->addMediaFromUrl($leagueImageUrl)->toMediaCollection('avatars');
                $players = Player::factory()->count(22)->create(['team_id' => $team->id]);
                foreach ($players as $player) {
                    $playerImageUrl = $faker->imageUrl(200, 200);
                    $player->addMediaFromUrl($playerImageUrl)->toMediaCollection('avatars');
                }
            });
        }
        */
    }
}