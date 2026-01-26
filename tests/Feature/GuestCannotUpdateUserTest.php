<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('guest cannot update a user', function () {

    $user = User::factory()->create([
        'name' => 'Original Name',
    ]);

    $this->patchJson("/api/users/{$user->id}", [
        'name' => 'Hacked Name',
    ])->assertStatus(401);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Original Name',
    ]);
});
