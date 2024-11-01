<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MatchRecord extends Model
{
    protected $fillable = [
        'type', 'team1_score', 'team2_score', 'season_id'
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(MatchParticipant::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
