<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * El usuario NO puede eliminar su propia cuenta
     */
    public function destroySelf(Request $request)
    {
        return response()->json([
            'message' => 'No puedes eliminar tu propio usuario.'
        ], 403);
    }

    /**
     * El usuario NO puede eliminar a otro usuario (para esta tarea lo bloqueamos siempre)
     */
    public function destroy(Request $request, User $user)
    {
        return response()->json([
            'message' => 'No tienes permiso para eliminar este usuario.'
        ], 403);
    }

    /**
     * ✅ Update con validación (Issue 4: email inválido debe retornar 422)
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'min:3', 'max:255'],

            // CLAVE del Issue 4
            'email' => [
                'sometimes',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            // Si ya estabas usando id_number, lo dejamos también
            'id_number' => [
                'sometimes',
                'string',
                'min:5',
                'max:20',
                'regex:/^[A-Za-z0-9\-]+$/',
                Rule::unique('users', 'id_number')->ignore($user->id),
            ],
        ]);

        $user->update($data);

        return response()->json([
            'message' => 'Updated',
            'data' => $user->fresh(),
        ], 200);
    }
}
