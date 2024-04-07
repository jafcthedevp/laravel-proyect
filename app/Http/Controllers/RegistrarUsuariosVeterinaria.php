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
            'pass' => 'required|string|min:5|confirmed',
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
    // create functionality
    public function create(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:255|unique:usuarios',
            'email' => '', 
            'pass' => 'required|string|min:5|confirmed',
        ]);

        $user = Usuario::create([ // Use the Usuario model
            'user' => $request->user,
            'email' => $request->email,
            'pass' => Hash::make($request->password_get_info),
        ]);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken($request->device_name)->plainTextToken,
        ], 201);
    }
    // update functionality
    public function update(Request $request, $id)
    {
        $request->validate([
            'user' => 'required|string|max:255|unique:usuarios,user,'.$id,
            'email' => '', 
            'pass' => 'required|string|min:5|confirmed',
        ]);

        $user = Usuario::findOrFail($id);
        $user->user = $request->user;
        $user->email = $request->email;
        $user->pass = Hash::make($request->password_get_info);
        $user->save();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken($request->device_name)->plainTextToken,
        ], 200);
    }
    // delete functionality
    public function destroy($id)
    {
        $user = Usuario::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'Successfully deleted user!'
        ], 200);
    }
    // show functionality
    public function show($id)
    {
        $user = Usuario::findOrFail($id);

        return response()->json([
            'user' => $user
        ], 200);
    }
    // index functionality
    public function index()
    {
        $users = Usuario::all();

        return response()->json([
            'users' => $users
        ], 200);
    }
}