<?php

namespace App\Services\Implement;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\Interface\IAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService implements IAuthService
{
    public function login(LoginRequest $request)
    {
        $input = $request->all();

        if (!Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            return response()->json(['error' => 'Invalid credentials!'], 401);
        }

        $user = User::where('email', $request->email)->first();

        return $user;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->all();

        $user = User::create(
            [
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($request->password)
            ]
        );

        return $user;
    }
}
