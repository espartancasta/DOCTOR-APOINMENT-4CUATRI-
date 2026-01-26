<?php

namespace Database\Seeders;

use App\Models\User;
<<<<<<< HEAD
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
=======
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario de prueba
        User::factory()->create([
            'name' => 'Pedro',
            'email' => 'joel.diaz.lopez7@gmail.com',
            'password' => bcrypt('12345678'),
            'id_number' => '12345678',
            'phone'=> '555-1234',
            'address'=> 'calle 234, colonia 543',
        ])->assignRole('doctor');
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
    }
}
