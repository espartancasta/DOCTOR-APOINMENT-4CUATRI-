<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('a user cannot delete their own account', function () {
    $user = User::factory()->create([
        'id_number' => 'TEST-SELF-001',
    ]);

    $this->actingAs($user, 'sanctum')
        ->delete('/api/user')
        ->assertStatus(403);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
    ]);
});

it('a user cannot delete another user account', function () {
    $user = User::factory()->create([
        'id_number' => 'TEST-USER-001',
    ]);

    $otherUser = User::factory()->create([
        'id_number' => 'TEST-USER-002',
    ]);

    $this->actingAs($user, 'sanctum')
        ->delete("/api/users/{$otherUser->id}")
        ->assertStatus(403);

    $this->assertDatabaseHas('users', [
        'id' => $otherUser->id,
    ]);
});
