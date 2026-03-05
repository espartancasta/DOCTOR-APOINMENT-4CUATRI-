<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user cannot self-delete their account', function () {
    // 1) Crear un usuario
    $user = User::factory()->create();

    // 2) Simular login
    $this->actingAs($user);

    // 3) Intentar borrarse a sí mismo
    $response = $this->delete(route('admin.users.destroy', $user));

    // 4) Debe bloquearse
    $response->assertStatus(403);

    // 5) El usuario sigue existiendo
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
    ]);
});
