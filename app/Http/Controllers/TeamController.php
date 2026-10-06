<?php

namespace App\Http\Controllers;

use App\Actions\Teams\CreateTeam;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class TeamController extends Controller
{
    public function create(): View
    {
        Gate::authorize('create', Team::class);

        return view('teams.create');
    }

    public function store(StoreTeamRequest $request, CreateTeam $createTeam): RedirectResponse
    {
        /** @var User $coach */
        $coach = $request->user();

        $createTeam->handle($coach, $request->validated('name'));

        return redirect()->route('dashboard');
    }

    public function show(Team $team): View
    {
        Gate::authorize('view', $team);

        return view('teams.show', ['team' => $team]);
    }
}
