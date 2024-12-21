<?php

namespace App\DataTransferObjects;

use App\Models\UserRating;

class TeamData
{
    public float $rating;
    /** @var UserRating[] */
    public array $players;

    public function __construct(float $rating, array $players)
    {
        $this->rating = $rating;
        $this->players = $players;
    }
}