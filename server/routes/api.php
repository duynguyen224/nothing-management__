<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/refresh', [AuthController::class, 'refresh']);
    Route::get('/auth/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);

    Route::get('/users/profile', [UserController::class, 'profile']);
    Route::get('/users/block', [UserController::class, 'blockUser']);

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/create', [ProductController::class, 'create']);
        Route::get('/{id}/detail', [ProductController::class, 'detail']);
        Route::post('/{id}/update', [ProductController::class, 'update']);
        Route::delete('/{id}/delete', [ProductController::class, 'delete']);
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/revenue', [DashboardController::class, 'revenue']);
        Route::get('/topCategories', [DashboardController::class, 'topCategories']);
    });
});
