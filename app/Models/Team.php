<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Team extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    //protected $fillable = ['name', 'avatar', 'league_id'];

    protected $guarded = [];
    
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }
    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')->singleFile();
    }
}
