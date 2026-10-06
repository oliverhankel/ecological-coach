<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        /** @var User $coach */
        $coach = $request->user();

        return view('dashboard', [
            'teams' => $coach->teams()->latest()->get(),
        ]);
    }
}
