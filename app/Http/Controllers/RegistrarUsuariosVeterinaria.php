<?php

namespace App\Http\Controllers;

use App\Models\Usuario; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:255|unique:usuarios',
            'email' => '', 
            'pass' => 'required|string|min:8|confirmed',
        ]);

        $user = Usuario::create([ // Usa el modelo Usuario
            'user' => $request->user,
            'email' => $request->email,
            'pass' => Hash::make($request->password_get_info),
        ]);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken($request->device_name)->plainTextToken,
        ], 201);
    }
}