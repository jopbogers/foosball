<?php

namespace App\Services;

use App\Helpers\RatingCalculator;
use App\Models\MatchParticipant;
use App\Models\MatchRecord;
use App\Models\Season;
use App\Models\UserRating;
use App\DataTransferObjects\TeamData;
use Exception;

class MatchService
{
    /**
     * @throws Exception
     */
    public function createMatch(
        string $matchType,
        int $scoreRed,
        int $scoreBlue,
        TeamData $redTeam,
        TeamData $blueTeam,
        Season $season
    ): MatchRecord {
        $calculator = new RatingCalculator(
            $blueTeam->rating,
            $redTeam->rating,
            $scoreBlue,
            $scoreRed
        );

        $match = MatchRecord::create([
            'type' => $matchType,
            'team_red_score' => $scoreRed,
            'team_blue_score' => $scoreBlue,
            'season_id' => $season->id
        ]);

        $this->addParticipants($match, 'red', $redTeam, $calculator->getNewRating('red'));
        $this->addParticipants($match, 'blue', $blueTeam, $calculator->getNewRating('blue'));

        $this->updatePlayers($redTeam, $blueTeam, $calculator, $scoreRed, $scoreBlue);

        return $match;
    }

    private function addParticipants(MatchRecord $match, string $team, TeamData $teamData, float $newRating): void
    {
        $ratingDiff = $newRating - $teamData->rating;
        foreach ($teamData->players as $player) {
            MatchParticipant::create([
                'match_id' => $match->id,
                'user_rating_id' => $player->id,
                'rating_before' => $player->rating,
                'rating_after' => $player->rating + $ratingDiff,
                'team' => $team,
            ]);
        }
    }

    /**
     * @throws Exception
     */
    private function updatePlayers(TeamData $redTeam, TeamData $blueTeam, RatingCalculator $calculator, int $scoreRed, int $scoreBlue): void
    {
        $this->applyPlayerUpdates($blueTeam, $calculator->getNewRating('blue'), $blueTeam->rating, $scoreBlue, $scoreRed);
        $this->applyPlayerUpdates($redTeam, $calculator->getNewRating('red'), $redTeam->rating, $scoreRed, $scoreBlue);
    }

    private function applyPlayerUpdates(TeamData $teamData, float $newRating, float $oldRating, int $scoreOwn, int $scoreOpp): void
    {
        $diff = $newRating - $oldRating;
        $winner = ($scoreOwn === 10);

        foreach ($teamData->players as $player) {
            $player->rating += $diff;
            $player->wins += $winner ? 1 : 0;
            $player->losses += $winner ? 0 : 1;
            $player->goals_for += $scoreOwn;
            $player->goals_against += $scoreOpp;
            $player->save();
        }
    }

    public function buildTeams(
        string $matchType,
        $playerRed1,
        $playerRed2,
        $playerBlue1,
        $playerBlue2,
        Season $season
    ): array {
        $redPlayers = [$playerRed1];
        $bluePlayers = [$playerBlue1];

        if ($matchType === '2v2') {
            $redPlayers[] = $playerRed2;
            $bluePlayers[] = $playerBlue2;
        }

        $fetchRating = fn($p) => UserRating::firstOrCreate([
            'user_id' => $p->id,
            'season_id' => $season->id,
        ])->refresh();

        $teamRed = array_map($fetchRating, $redPlayers);
        $teamBlue = array_map($fetchRating, $bluePlayers);

        $redRating = array_sum(array_map(fn($p) => $p->rating, $teamRed));
        $blueRating = array_sum(array_map(fn($p) => $p->rating, $teamBlue));

        return [
            'red' => new TeamData($redRating, $teamRed),
            'blue' => new TeamData($blueRating, $teamBlue)
        ];
    }
}


