<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchParticipant extends Model
{
    protected $fillable = [
        'match_id',
        'user_rating_id',
        'rating_before',
        'rating_after',
        'team'
    ];

    public function userRating(): BelongsTo
    {
        return $this->belongsTo(UserRating::class);
    }

    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchRecord::class);
    }
}
