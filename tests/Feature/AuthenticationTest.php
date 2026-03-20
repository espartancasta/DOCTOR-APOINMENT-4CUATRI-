<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    if ($response->status() !== 200) {
        dump($response->status());
        dump($response->headers->get('Location'));
    }

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/admin');
});

test('users cannot authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});
