<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function readAll()
    {
        $users = User::get();

        return response()->json([
            'data' => $users,
        ], 200);
    }

    function register(Request $request)
    {
        $data = $request->only(['name', 'email', 'password']);

        $data['username'] = Str::of($request->name)->slug('');

        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $users = User::create($data);

        return response()->json([
            'data' => $users,
        ], 201);
    }

    function login(Request $request)
    {
        $data = $request->only(['email', 'password']);

        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $users = User::where('email', $data['email'])->firstOrFail();

        $token = $users->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $users,
            'token' => $token,
        ], 200);
    }
}
