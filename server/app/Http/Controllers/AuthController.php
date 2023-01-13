<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Services\Interface\IAuthService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Monolog\Handler\SwiftMailerHandler;

class AuthController extends Controller
{
    private IAuthService $authService;

    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $res = $this->authService->login($request);

        if ($res instanceof Model) {
            return $this->createNewToken($res);
        }

        return $res; // Error information
    }

    public function register(RegisterRequest $request)
    {
        return response()->json('Need to implement!');

        // $user = $this->authService->register($request);

        // return response()->json([
        //     'message' => 'User successfully registered',
        //     'user' => $user
        // ], 201);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh(Request $request)
    {
        $this->authService->refresh($request);

        return $this->createNewToken($request->user());
    }

    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    protected function createNewToken($user)
    {
        $assignRole = '';
        switch ($user->role) {
            case Role::ADMIN:
                $assignRole = Role::ADMIN;
                break;
            case Role::YARD_OWNER:
                $assignRole = Role::YARD_OWNER;
                break;
            case Role::CLIENT:
                $assignRole = Role::CLIENT;
                break;
            default:
        }
        return response()->json([
            // 'access_token' => $user->createToken('auth_token', [$assignRole])->plainTextToken,
            'access_token' => $user->createToken($user->email, [$assignRole])->plainTextToken,
            'type' => 'Bearer',
            'user' => auth()->user(),
        ]);
    }

    public function changePassword(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'old_password' => 'required|string|min:6',
        //     'new_password' => 'required|string|confirmed|min:6',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors()->toJson(), 400);
        // }
        // $userId = auth()->user()->id;

        // $user = User::where('id', $userId)->update(
        //     ['password' => bcrypt($request->new_password)]
        // );

        // return response()->json([
        //     'message' => 'User successfully changed password',
        //     'user' => $user,
        // ], 201);
    }

    public function test(Request $request)
    {
        return response()->json('test');
    }
}
