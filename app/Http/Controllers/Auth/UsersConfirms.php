<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;
}
    class UsersConfirms extends Controller
{

    // Resto de tu código de modelo...
    public function confirm(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = auth()->user();

    if (!$user) {
        return response()->json(['message' => 'No authenticated user'], 401);
    }

    // Actualizar al usuario en la base de datos
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->save();

    return response()->json(['message' => 'User updated successfully']);
    }
}

