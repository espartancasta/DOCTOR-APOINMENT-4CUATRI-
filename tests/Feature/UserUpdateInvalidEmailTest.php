<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('update fails when email has invalid format', function () {

    // Usuario autenticado (el que hace la petición)
    $actor = User::factory()->create();

    // Usuario objetivo que queremos actualizar
    $target = User::factory()->create([
        'email' => 'target@example.com',
    ]);

    $this->actingAs($actor, 'sanctum')
        ->patchJson("/api/users/{$target->id}", [
            'email' => 'not-an-email',
        ])
        ->assertStatus(422);

    // Confirmar que el email NO cambió en DB
    $this->assertDatabaseHas('users', [
        'id' => $target->id,
        'email' => 'target@example.com',
    ]);
});
