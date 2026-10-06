<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCoachHasTeam
{
    /** @param Closure(Request): Response $next */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $coach */
        $coach = $request->user();

        if (! $coach->teams()->exists()) {
            return redirect()->route('teams.create');
        }

        return $next($request);
    }
}
