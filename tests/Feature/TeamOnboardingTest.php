<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\URL;

test('verified coaches without a team are guided to team creation without a redirect loop', function () {
    $coach = User::factory()->create();

    $this->actingAs($coach)
        ->get(route('dashboard'))
        ->assertRedirect(route('teams.create'));

    $this->get(route('teams.create'))
        ->assertOk()
        ->assertSeeText('Create a team');
});

test('email verification leads a new coach to team creation', function () {
    $coach = User::factory()->unverified()->create();
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $coach->id, 'hash' => sha1($coach->email)],
    );

    $this->actingAs($coach)
        ->get($verificationUrl)
        ->assertRedirect(route('dashboard', absolute: false).'?verified=1');

    $this->get(route('dashboard'))
        ->assertRedirect(route('teams.create'));

    $this->get(route('teams.create'))->assertOk();
});

test('a coach can create a team and is redirected to the dashboard', function () {
    $coach = User::factory()->create();

    $this->actingAs($coach)
        ->post(route('teams.store'), ['name' => 'Green Runners'])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('teams', [
        'name' => 'Green Runners',
        'coach_id' => $coach->id,
    ]);

    $this->get(route('dashboard'))
        ->assertOk()
        ->assertSeeText('Green Runners');
});

test('a coach can create more than one team', function () {
    $coach = User::factory()->create();

    $this->actingAs($coach);
    $this->post(route('teams.store'), ['name' => 'First Team'])->assertRedirect(route('dashboard'));
    $this->post(route('teams.store'), ['name' => 'Second Team'])->assertRedirect(route('dashboard'));

    expect($coach->teams()->count())->toBe(2);

    $this->get(route('dashboard'))
        ->assertSeeText('First Team')
        ->assertSeeText('Second Team');

    $this->get(route('teams.create'))->assertOk();
});

test('an empty team name is rejected', function () {
    $coach = User::factory()->create();

    $this->actingAs($coach)
        ->post(route('teams.store'), ['name' => ''])
        ->assertSessionHasErrors('name');

    $this->assertDatabaseCount('teams', 0);
});

test('a client cannot assign a different coach when creating a team', function () {
    $coach = User::factory()->create();
    $otherCoach = User::factory()->create();

    $this->actingAs($coach)
        ->post(route('teams.store'), ['name' => 'Green Runners', 'coach_id' => $otherCoach->id])
        ->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('teams', [
        'name' => 'Green Runners',
        'coach_id' => $coach->id,
    ]);
});

test('the dashboard shows only teams belonging to the signed in coach', function () {
    $coach = User::factory()->create();
    $otherCoach = User::factory()->create();
    Team::factory()->for($coach, 'coach')->create(['name' => 'Own Team']);
    Team::factory()->for($otherCoach, 'coach')->create(['name' => 'Foreign Team']);

    $this->actingAs($coach)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSeeText('Own Team')
        ->assertDontSeeText('Foreign Team');
});

test('a coach cannot directly open another coaches team', function () {
    $coach = User::factory()->create();
    $otherCoach = User::factory()->create();
    $ownTeam = Team::factory()->for($coach, 'coach')->create();
    $foreignTeam = Team::factory()->for($otherCoach, 'coach')->create();

    $this->actingAs($coach)
        ->get(route('teams.show', $ownTeam))
        ->assertOk()
        ->assertSeeText($ownTeam->name);

    $this->get(route('teams.show', $foreignTeam))->assertForbidden();
});

test('unverified users cannot create a team', function () {
    $coach = User::factory()->unverified()->create();

    $this->actingAs($coach)
        ->get(route('teams.create'))
        ->assertRedirect(route('verification.notice'));

    $this->post(route('teams.store'), ['name' => 'Green Runners'])
        ->assertRedirect(route('verification.notice'));

    $this->assertDatabaseCount('teams', 0);
});
