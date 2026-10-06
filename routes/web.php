<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\EnsureCoachHasTeam;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)
        ->middleware(EnsureCoachHasTeam::class)
        ->name('dashboard');

    Route::get('teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('teams/{team}', [TeamController::class, 'show'])->name('teams.show');
});

require __DIR__.'/settings.php';
