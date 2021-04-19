<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password'))){
            return response([
                'message' => 'Invalid credentials'
            ]);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        return response([
            'message' => 'Login successfully',
            'token' => $token
        ]);
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response([
            'message' => 'Logout successfully',
        ]);
    }
}
