<?php

namespace App\Livewire;

use App\Models\Season;
use App\Models\User;
use App\Services\MatchService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;

class AddMatch extends Component
{
    public Season $season;

    public bool $disabled = false;
    public string $matchType = '2v2';
    public ?int $scoreRed = 0;
    public ?int $scoreBlue = 0;

    public ?User $playerRed1 = null;
    public ?User $playerRed2 = null;
    public ?User $playerBlue1 = null;
    public ?User $playerBlue2 = null;

    public function mount(): void
    {
        $this->season = Season::latest()->first();
    }

    #[On('player-red-1')]
    public function setPlayerRed1(?User $user): void
    {
        $this->playerRed1 = $user;
    }

    #[On('player-red-2')]
    public function setPlayerRed2(?User $user): void
    {
        $this->playerRed2 = $user;
    }

    #[On('player-blue-1')]
    public function setPlayerBlue1(?User $user): void
    {
        $this->playerBlue1 = $user;
    }

    #[On('player-blue-2')]
    public function setPlayerBlue2(?User $user): void
    {
        $this->playerBlue2 = $user;
    }

    public function updatedMatchType()
    {
        $this->playerRed2 = null;
        $this->playerBlue2 = null;
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        if (!$this->checkValid()) {
            return;
        }

        $service = new MatchService();

        $teams = $service->buildTeams(
            $this->matchType,
            $this->playerRed1,
            $this->playerRed2,
            $this->playerBlue1,
            $this->playerBlue2,
            $this->season
        );

        $service->createMatch(
            $this->matchType,
            $this->scoreRed,
            $this->scoreBlue,
            $teams['red'],
            $teams['blue'],
            $this->season
        );
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.add-match', ['valid' => $this->checkValid()]);
    }

    private function checkValid(): bool
    {
        if ($this->matchType === '2v2') {
            if (
                is_null($this->playerRed1) ||
                is_null($this->playerRed2) ||
                is_null($this->playerBlue1) ||
                is_null($this->playerBlue2)
            ) {
                return false;
            }

            $players = [
                $this->playerRed1,
                $this->playerRed2,
                $this->playerBlue1,
                $this->playerBlue2
            ];

            if (count($players) !== count(array_unique($players))) {
                return false;
            }
        } elseif ($this->matchType === '1v1') {
            if (is_null($this->playerRed1) || is_null($this->playerBlue1)) {
                return false;
            }

            if ($this->playerRed1 === $this->playerBlue1) {
                return false;
            }
        } else {
            return false;
        }

        if (
            ($this->scoreRed > 10 || $this->scoreBlue > 10) ||              // No score may be over 10
            ($this->scoreRed === 10 && $this->scoreBlue === 10) ||          // Both cannot have 10
            ($this->scoreRed !== 10 && $this->scoreBlue !== 10)             // Exactly one must have 10
        ) {
            return false;
        }

        return true;
    }
}
