<?php

namespace App\Actions\Teams;

use App\Models\Team;
use App\Models\User;

class CreateTeam
{
    public function handle(User $coach, string $name): Team
    {
        return $coach->teams()->create(['name' => $name]);
    }
}
