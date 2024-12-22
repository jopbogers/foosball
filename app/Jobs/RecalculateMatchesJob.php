<?php

namespace App\Jobs;

use App\DataTransferObjects\TeamData;
use App\Helpers\RatingCalculator;
use App\Models\Season;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RecalculateMatchesJob implements ShouldQueue
{
    use Queueable;

    private Season $season;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->season = Season::latest()->first();
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): void
    {
        $this->resetUserRatings();
        $this->recalculateMatches();
    }

    private function resetUserRatings(): void
    {
        $this->season->players->each(function ($player) {
            $player->rating = 1000;
            $player->wins = 0;
            $player->losses = 0;
            $player->goals_for = 0;
            $player->goals_against = 0;
            $player->save();
        });
    }

    /**
     * @throws Exception
     */
    private function recalculateMatches(): void
    {
        $this->season->matches->each(function ($match) {
            $teamBlue = $this->buildTeamData($match->teamBlue);
            $teamRed = $this->buildTeamData($match->teamRed);
            $winner = ($match->team_blue_score > $match->team_red_score) ? 'blue' : 'red';

            $calculator = new RatingCalculator(
                $teamBlue->rating,
                $teamRed->rating,
                $match->team_blue_score,
                $match->team_red_score
            );

            $match->participants->each(function ($participant) use ($teamBlue, $teamRed, $calculator, $match, $winner) {
                $this->updateParticipantStats($participant, $teamBlue, $teamRed, $calculator, $match, $winner);
            });
        });
    }

    private function buildTeamData($teamPlayers): TeamData
    {
        $teamData = new TeamData();

        foreach ($teamPlayers as $player) {
            $teamData->addPlayer($player->userRating);
        }

        return $teamData;
    }

    /**
     * @throws Exception
     */
    private function updateParticipantStats(
        $participant,
        TeamData $teamBlue,
        TeamData $teamRed,
        RatingCalculator $calculator,
        $match,
        string $winner
    ): void {
        $participant->rating_before = $participant->userRating->rating;

        $originalRating = $participant->team === 'blue' ? $teamBlue->rating : $teamRed->rating;
        $newRating = $calculator->getNewRating($participant->team);
        $points = $newRating - $originalRating;

        $participant->userRating->rating += $points;
        $participant->rating_after = $participant->userRating->rating;

        if ($participant->team === $winner) {
            $participant->userRating->wins++;
        } else {
            $participant->userRating->losses++;
        }

        if ($participant->team === 'blue') {
            $participant->userRating->goals_for += $match->team_blue_score;
            $participant->userRating->goals_against += $match->team_red_score;
        } else {
            $participant->userRating->goals_for += $match->team_red_score;
            $participant->userRating->goals_against += $match->team_blue_score;
        }

        $participant->save();
        $participant->userRating->save();
    }
}
