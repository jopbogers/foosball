<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRating extends Model
{
    protected $fillable = [
        'user_id',
        'season_id',
        'rating'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
