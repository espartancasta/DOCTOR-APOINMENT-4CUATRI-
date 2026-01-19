<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/|unique:users,id_number',
            'phone' => 'required|digits_between:7,15',
            'address' => 'required|string|min:3|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_number' => $data['id_number'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);

        // Spatie: asignar rol por ID
        $role = Role::findOrFail($data['role_id']);
        $user->syncRoles([$role->name]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario creado',
            'text' => 'El usuario ha sido creado exitosamente.',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/|unique:users,id_number,' . $user->id,
            'phone' => 'required|digits_between:7,15',
            'address' => 'required|string|min:3|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'id_number' => $data['id_number'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);

        if (!empty($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        // Spatie: actualizar rol
        $role = Role::findOrFail($data['role_id']);
        $user->syncRoles([$role->name]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario actualizado',
            'text' => 'El usuario ha sido actualizado exitosamente.',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        // Spatie: quitar roles
        $user->syncRoles([]);

        $user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario eliminado',
            'text' => 'El usuario ha sido eliminado exitosamente.',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
