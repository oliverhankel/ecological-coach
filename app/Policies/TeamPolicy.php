<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;

class TeamPolicy
{
    public function view(User $user, Team $team): bool
    {
        return $team->coach_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->hasVerifiedEmail();
    }
}
