<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('guest cannot delete a user', function () {

    $user = User::factory()->create();

    // Petición SIN autenticación (guest)
    $this->deleteJson("/api/users/{$user->id}")
        ->assertStatus(401);

    // Confirmar que el usuario NO fue eliminado
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
    ]);
});
