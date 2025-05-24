<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        try{
            $fields = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|unique:users',
                'password' => 'required|string',
                'role'     => 'nullable|string|in:admin,client,agent',
            ]);

            $userData = [
                'name'     => $fields['name'],
                'email'    => $fields['email'],
                'password' => bcrypt($fields['password']),
            ];

            if (isset($fields['role'])) {
                $userData['role'] = $fields['role'];
            }

            $user = User::create($userData);

            $token = $user->createToken('token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token], 201);


        }catch(ValidationException $e){
                return response()->json(['errors' => $e->errors()], 201);
        }
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

