<?php

use App\Models\User;

test('guests can open the homepage and reach the existing authentication routes', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSeeText('Dein Team.')
        ->assertSeeText('Dein Coaching.')
        ->assertSeeText('Ein klarer Start.')
        ->assertSeeText('Als Coach registrieren')
        ->assertSee('href="'.route('register').'"', false)
        ->assertSee('href="'.route('login').'"', false)
        ->assertDontSee('href="#"', false);
});

test('signed in coaches see the dashboard action instead of registration', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('home'))
        ->assertOk()
        ->assertSeeText('Zur Teamübersicht')
        ->assertSee('href="'.route('dashboard').'"', false)
        ->assertDontSee('href="'.route('register').'"', false);
});
