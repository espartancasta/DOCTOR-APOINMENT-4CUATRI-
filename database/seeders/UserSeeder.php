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
        // Asegurar que el rol exista
        Role::firstOrCreate([
            'name' => 'doctor',
            'guard_name' => 'web',
        ]);

        // Crear/actualizar un usuario de prueba
        $user = User::updateOrCreate(
            ['email' => 'joel.diaz.lopez7@gmail.com'],
            [
                'name' => 'Pedro',
                'password' => Hash::make('12345678'),
                'id_number' => '12345678',
                'phone' => '5551234',
                'address' => 'calle 234, colonia 543',
            ]
        );

        // Asignar rol (Spatie)
        $user->syncRoles(['doctor']);
    }
}
