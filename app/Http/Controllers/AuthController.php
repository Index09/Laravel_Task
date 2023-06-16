<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\Has18Years;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'birthdate' => ['required', 'date', new Has18Years],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
        ]);

        // Optionally, you can generate a token for the newly registered user using Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
