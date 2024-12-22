<?php

namespace App\Livewire;

use App\Jobs\RecalculateMatchesJob;
use App\Models\MatchRecord;
use App\Models\User;
use App\Models\UserRating;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class EditMatch extends AddMatch
{
    public MatchRecord $match;

    public function mount(): void
    {
        parent::mount();
        $this->matchType = $this->match->type;
        $this->scoreBlue = $this->match->team_blue_score;
        $this->scoreRed = $this->match->team_red_score;

        $this->playerBlue1 = $this->match->teamBlue[0]->userRating->user;
        $this->playerRed1 = $this->match->teamRed[0]->userRating->user;

        if ($this->matchType == '2v2') {
            $this->playerBlue2 = $this->match->teamBlue[1]->userRating->user;
            $this->playerRed2 = $this->match->teamRed[1]->userRating->user;
        }
    }

    public function save()
    {
        if (! $this->checkValid() || ! Auth::user()->admin) {
            return;
        }

        $this->match->team_blue_score = $this->scoreBlue;
        $this->match->team_red_score  = $this->scoreRed;
        $this->match->save();

        $this->ensureUserRating($this->match->teamBlue, 0, $this->playerBlue1);
        $this->ensureUserRating($this->match->teamRed, 0, $this->playerRed1);

        if ($this->matchType === '2v2') {
            $this->ensureUserRating($this->match->teamBlue, 1, $this->playerBlue2);
            $this->ensureUserRating($this->match->teamRed, 1, $this->playerRed2);
        }

        RecalculateMatchesJob::dispatch();
        session()->flash('success', 'Match updated successfully.');
        $this->redirectRoute('matches');
    }

    public function delete()
    {
        $this->match->delete();
        RecalculateMatchesJob::dispatch();
        session()->flash('success', 'Match deleted successfully.');
        $this->redirectRoute('matches');
    }

    private function ensureUserRating(Collection $team, int $index,User $player): void
    {
        if ($team[$index]->userRating->user_id !== $player->id) {
            $team[$index]->user_rating_id = UserRating::firstOrCreate([
                'user_id'   => $player->id,
                'season_id' => $this->season->id,
            ])->id;
            $team[$index]->save();
        }
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.edit-match', ['valid' => $this->checkValid()]);
    }
}
