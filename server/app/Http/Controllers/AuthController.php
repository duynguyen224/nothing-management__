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

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $user = $this->authService->login($request);

        if ($user instanceof Model) {
            return $this->createNewToken($user);
        }

        return $user; // Error information
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        // return $this->createNewToken(Auth::refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
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
            'access_token' => $user->createToken('auth_token', [$assignRole])->plainTextToken,
            'type' => 'bearer',
            'user' => auth()->user()
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
