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
        // 1) Crear rol si no existe
        Role::firstOrCreate([
            'name' => 'doctor',
            'guard_name' => 'web',
        ]);

        // 2) Crear usuario si no existe
        $user = User::firstOrCreate(
            ['email' => 'joel.diaz.lopez7@gmail.com'],
            [
                'name' => 'Pedro',
                'password' => Hash::make('12345678'),
                'id_number' => '12345678',
                'phone' => '555-1234',
                'address' => 'calle 234, colonia 543',
            ]
        );

        // 3) Asignar rol (si no lo tiene)
        if (! $user->hasRole('doctor')) {
            $user->assignRole('doctor');
        }
    }
}
