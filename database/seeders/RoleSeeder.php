<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;
=======
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role as ContractsRole;
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
<<<<<<< HEAD
    public function run(): void
    {
=======
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Definir roles
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
        $roles = [
            'Paciente',
            'Doctor',
            'Recepcionista',
            'Administrador',
        ];
<<<<<<< HEAD

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web'
            ]);
        }
    }
=======
        //Crear roles
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }   
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
}
