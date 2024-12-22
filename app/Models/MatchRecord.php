<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MatchRecord extends Model
{
    protected $fillable = [
        'type', 'team_red_score', 'team_blue_score', 'season_id'
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(MatchParticipant::class, 'match_id');
    }

    public function teamBlue(): HasMany
    {
       return $this->participants()->where('team', 'blue');
    }

    public function teamRed(): HasMany
    {
       return $this->participants()->where('team', 'red');
    }

    public function teamRedPoints(): int
    {
        $player = $this->teamRed()->first();
        return $player->rating_after - $player->rating_before;
    }

    public function teamBluePoints(): int
    {
        $player = $this->teamBlue()->first();
        return $player->rating_after - $player->rating_before;
    }

    public function getDate(): string
    {
        if ($this->created_at->isToday()) {
            // "Today HH:ii"
            return "Today " . $this->created_at->format('H:i');
        } elseif ($this->created_at->isYesterday()) {
            // "Yesterday HH:ii"
            return "Yesterday " . $this->created_at->format('H:i');
        } elseif ($this->created_at->isCurrentYear()) {
            // "DD-MM HH:ii" (like 20-12 13:50)
            return $this->created_at->format('d-m H:i');
        } else {
            // "DD-MM-YY HH:ii" (like 20-12-23 13:50 if older than current year)
            return $this->created_at->format('d-m-y H:i');
        }
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
