<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Rol creado correctamente',
            'text'  => 'El rol ha sido creado exitosamente',
        ]);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // Restringir la acción para los primeros 4 roles
        if ($role->id <= 4) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Error',
                'text'  => 'No puedes editar este rol',
            ]);

            return redirect()->route('admin.roles.index');
        }

        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        // Si el campo no cambió, no actualices
        if ($role->name === $request->name) {
            session()->flash('swal', [
                'icon'  => 'info',
                'title' => 'Sin cambios',
                'text'  => 'No se detectaron modificaciones',
            ]);

            return redirect()->route('admin.roles.edit', $role);
        }

        $role->update(['name' => $request->name]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Rol actualizado correctamente',
            'text'  => 'El rol ha sido actualizado exitosamente',
        ]);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Restringir eliminación para los primeros 4 roles
        if ($role->id <= 4) {
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'No se puede eliminar el rol',
                'text'  => 'Este rol está protegido y no puede ser eliminado',
            ]);

            return redirect()->route('admin.roles.index');
        }

        $roleName = $role->name;
        $role->delete();

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Rol eliminado correctamente',
            'text'  => 'El rol ' . $roleName . ' ha sido eliminado exitosamente',
        ]);

        return redirect()->route('admin.roles.index');
    }
}
