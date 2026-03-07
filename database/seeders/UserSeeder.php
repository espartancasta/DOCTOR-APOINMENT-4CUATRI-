<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Makes sure the role exists
        Role::firstOrCreate([
            'name' => 'doctor',
            'guard_name' => 'web',
        ]);

        // Create/update a test user
        $user = User::updateOrCreate(
            ['email' => 'enriquecastayucatan@gmail.com'],
            [
                'name' => 'Jose',
                'password' => Hash::make('12345678'),
                'id_number' => '12345678',
                'phone' => '5551234',
                'address' => 'calle 234, colonia 543',
            ]
        );

        // Assign role (Spatie)
        $user->syncRoles(['doctor']);
    }
}
