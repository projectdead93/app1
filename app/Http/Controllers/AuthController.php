<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    function register(Request $request)
    {
        $fields = $request->validate([

            'username' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'

        ]);

        $user = User::create([

            'username' => $fields['username'],
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])

        ]);

        $token = $user->createToken('appToken')->plainTextToken;

        $response = [

            'user' => $user,
            'token' => $token

        ];

        return response()->json($response, 201);
    }

    function login(Request $request)
    {
        $fields = $request->validate([

            'email' => 'required|string',
            'password' => 'required|string'

        ]);

        //Check username/email
        $user = User::where('email', $fields['email'])->first();

        //Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            # code...
            return response()->json(['message' => "Incorrect Credentials"], 401);
        }

        //if above checks where fulfilled will proceed to Token generation process below

        $token = $user->createToken('appToken')->plainTextToken;

        $response = [

            'user' => $user,
            'token' => $token

        ];

        return response()->json($response, 201);
    }

    function logout()
    {

        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged Out'], 201);
    }
}
