<?php

namespace App\Helpers;

use Exception;

class RatingCalculator
{
    public const TEAM_BLUE = 'blue';
    public const TEAM_RED  = 'red';

    private const DEFAULT_K_FACTOR = 20;
    private const BASE_RATING = 400;

    private int $kFactor;
    private float $ratingTeamBlue;
    private float $ratingTeamRed;
    private array $newRatings = [];

    /**
     * @throws Exception
     */
    public function __construct(
        float $ratingTeamBlue,
        float $ratingTeamRed,
        int $scoreTeamBlue,
        int $scoreTeamRed,
        int $kFactor = self::DEFAULT_K_FACTOR
    ) {
        if ($scoreTeamBlue === $scoreTeamRed) {
            throw new Exception('Scores are equal, cannot determine a winner.');
        }

        $this->kFactor = $kFactor;
        $this->ratingTeamBlue = $ratingTeamBlue;
        $this->ratingTeamRed = $ratingTeamRed;

        $this->calculate($scoreTeamBlue, $scoreTeamRed);
    }

    /**
     * @throws Exception
     */
    public function getNewRating(string $team): float
    {
        if (!isset($this->newRatings[$team])) {
            throw new Exception('Invalid team.');
        }

        return $this->newRatings[$team];
    }

    private function calculate(int $scoreTeamBlue, int $scoreTeamRed): void
    {
        $winner = ($scoreTeamBlue > $scoreTeamRed) ? self::TEAM_BLUE : self::TEAM_RED;
        $blueExpectation = 1 / (1 + 10 ** (($this->ratingTeamRed - $this->ratingTeamBlue) / self::BASE_RATING));
        $redExpectation  = 1 / (1 + 10 ** (($this->ratingTeamBlue - $this->ratingTeamRed) / self::BASE_RATING));

        $scoreBlue = ($winner === self::TEAM_BLUE) ? 1 : 0;
        $scoreRed  = ($winner === self::TEAM_RED)  ? 1 : 0;

        $this->newRatings[self::TEAM_BLUE] = $this->ratingTeamBlue + $this->kFactor * ($scoreBlue - $blueExpectation);
        $this->newRatings[self::TEAM_RED]  = $this->ratingTeamRed  + $this->kFactor * ($scoreRed - $redExpectation);
    }
}
