<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class League extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    //protected $fillable = ['name', 'avatar'];
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')->singleFile();
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
    public function players()
    {
        return $this->hasManyThrough(Player::class, Team::class);
    }
}