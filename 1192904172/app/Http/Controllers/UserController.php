<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Método para registrar un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash de la contraseña
        ]);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    // Método para obtener la lista de usuarios
    public function index()
    {
        $users = User::select('id', 'name', 'email')->get(); // No incluimos el password
        return response()->json($users);
    }
}
