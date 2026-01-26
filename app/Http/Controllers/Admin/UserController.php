<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
=======
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra la lista de usuarios.
     */
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
    public function index()
    {
        return view('admin.users.index');
    }

<<<<<<< HEAD
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.users.create', compact('roles'));
    }

=======
    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $roles= Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Guarda un nuevo usuario (temporalmente vacío).
     */
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
<<<<<<< HEAD
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
=======
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/|unique:users',
            'phone' => 'required|digits between:7,15',
            'address' => 'required|string|min:3|max:255',
            'role_id'=>'required|exists:roles,id',
        ]);

        $user = User::create($data);

        $user->roles()->attach($data['role_id']);
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario creado',
            'text' => 'El usuario ha sido creado exitosamente.',
<<<<<<< HEAD
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
=======
            ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');


    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(User $user)
    {
        $roles= Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza un usuario existente (temporalmente vacío).
     */
    public function update(Request $request, User $user)
    {
         $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|unique:users,email,'. $user->id,
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/|unique:users,id_number,'. $user->id,
            'phone' => 'required|digits between:7,15',
            'address' => 'required|string|min:3|max:255',
            'role_id'=>'required|exists:roles,id',
        ]);

        $user->update($data);

        //si el usuario quiere editar su contraseña que lo guarde

        if( $request ->filled('password') ) {
            $user->password = bcrypt($request->password);
            $user->save();

        $user->roles()->sync($data['role_id']);
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario actualizado',
            'text' => 'El usuario ha sido actualizado exitosamente.',
<<<<<<< HEAD
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        // Spatie: quitar roles
        $user->syncRoles([]);

=======
            ]);

    }

    return redirect()->route('admin.users.index', $user->id)->with('success', 'Usuario actualizado exitosamente.');
}

    /**
     * Elimina un usuario (temporalmente vacío).
     */
    public function destroy(User $user)
    {

         // No permitir que un usuario se elimine a sí mismo
        if (auth()->id() === $user->id) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'No puedes eliminar tu propio usuario.',  
            ]);
            abort(403, 'No puedes eliminar tu propio usuario.');

        //Eliminar roles asocioados a un usuario
        $user->roles()->detach();

        //Eliminar usuario
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
        $user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario eliminado',
            'text' => 'El usuario ha sido eliminado exitosamente.',
<<<<<<< HEAD
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
=======
            ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
    }

}        }                      
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
