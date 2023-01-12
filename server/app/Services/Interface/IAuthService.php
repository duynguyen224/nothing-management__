<?php

namespace App\Services\Interface;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

interface IAuthService
{
    public function login(LoginRequest $request);
    public function logout(Request $request);
    public function refresh(Request $request);
    public function register(RegisterRequest $request);
}
