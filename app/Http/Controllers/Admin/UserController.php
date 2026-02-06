<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Muestra la lista de usuarios.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Guarda un nuevo usuario.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'min:3', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'id_number' => ['required', 'string', 'min:5', 'max:20', 'regex:/^[A-Za-z0-9\-]+$/', 'unique:users,id_number'],
            'phone'     => ['required', 'digits_between:7,15'],
            'address'   => ['required', 'string', 'min:3', 'max:255'],
            'role_id'   => ['required', 'exists:roles,id'],
        ]);

        // Crear usuario (password con hash)
        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'id_number' => $data['id_number'],
            'phone'     => $data['phone'],
            'address'   => $data['address'],
        ]);

        // Asignar rol (Spatie)
        $role = Role::findOrFail($data['role_id']);
        $user->syncRoles([$role->name]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario creado',
            'text'  => 'El usuario ha sido creado exitosamente.',
        ]);

        // Si el usuario creado es Paciente -> crear registro en patients y redirigir a editar
        if (method_exists($user, 'role') && $user->role('Paciente')) {
            // Requiere relación patient() en User: hasOne(Patient::class)
            $patient = $user->patient()->firstOrCreate([]);
            return redirect()->route('admin.patients.edit', $patient);
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza un usuario existente.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'min:3', 'max:255'],
            'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'id_number' => ['required', 'string', 'min:5', 'max:20', 'regex:/^[A-Za-z0-9\-]+$/', Rule::unique('users', 'id_number')->ignore($user->id)],
            'phone'     => ['required', 'digits_between:7,15'],
            'address'   => ['required', 'string', 'min:3', 'max:255'],
            'password'  => ['nullable', 'string', 'min:8', 'confirmed'],
            'role_id'   => ['required', 'exists:roles,id'],
        ]);

        // Actualizar campos
        $user->update([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'id_number' => $data['id_number'],
            'phone'     => $data['phone'],
            'address'   => $data['address'],
        ]);

        // Si viene password, actualizar
        if (!empty($data['password'])) {
            $user->update([
                'password' => Hash::make($data['password']),
            ]);
        }

        // Actualizar rol (Spatie)
        $role = Role::findOrFail($data['role_id']);
        $user->syncRoles([$role->name]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario actualizado',
            'text'  => 'El usuario ha sido actualizado exitosamente.',
        ]);

        // Si ahora es Paciente -> asegurar Patient
        if (method_exists($user, 'role') && $user->role('Paciente')) {
            $user->patient()->firstOrCreate([]);
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Elimina un usuario.
     */
    public function destroy(User $user)
    {
        // No permitir que un usuario se elimine a sí mismo (requisito del test)
        if (auth()->id() === $user->id) {
            abort(403);
        }

        // Spatie: remover roles antes de borrar
        if (method_exists($user, 'roles')) {
            $user->roles()->detach();
        }

        $user->delete();

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario eliminado',
            'text'  => 'El usuario ha sido eliminado exitosamente.',
        ]);

        return redirect()->route('admin.users.index');
    }
}
