<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
     * El usuario NO puede eliminar a otro usuario
     */
    public function destroy(User $user)
    {
        return response()->json([
            'message' => 'No tienes permiso para eliminar este usuario.'
        ], 403);
    }
}
