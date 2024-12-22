<?php

namespace App\DataTransferObjects;

use App\Models\UserRating;

class TeamData
{
    public float $rating;
    /** @var UserRating[] */
    public array $players;

    public function __construct(float $rating = 0.0, array $players = [])
    {
        $this->rating = $rating;
        $this->players = $players;
    }

    public function addPlayer(UserRating $player): void
    {
        $this->rating += $player->rating;
        $this->players[] = $player;
    }
}
