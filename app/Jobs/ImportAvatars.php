<?php

namespace App\Jobs;

use App\Models\League;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Faker\Factory as Faker;

class ImportAvatars implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;
    public $timeout = 3600;

    public function __construct(string $model)
    {
        $this->model = $model;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = collect([]);
        $faker = Faker::create();

        if ($this->model == 'leagues') {
            $data = League::get();
        }
        if ($this->model == 'teams') {
            $data = Team::get();
        }
        if ($this->model == 'players') {
            $data = Player::get();
        }
        foreach ($data as $key => $value) {
            $teamImageUrl = $faker->imageUrl(200, 200);
            $value->addMediaFromUrl($teamImageUrl)->toMediaCollection('avatars');
        }

        \Log::info("count ", [$data->count()]);
    }
}