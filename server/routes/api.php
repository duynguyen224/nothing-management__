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

Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/auth/logout', 'logout');
        Route::post('/auth/refresh', 'refresh');
        Route::get('/auth/user-profile', 'userProfile');
        Route::post('/auth/change-password', 'changePassword');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users/profile', 'profile');
        Route::get('/users/block', 'blockUser');
    });

    Route::prefix('dashboard')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/revenue', 'revenue');
            Route::get('/topCategories', 'topCategories');
        });
    });

    Route::prefix('products')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/create', 'create');
            Route::get('/{id}/detail', 'detail');
            Route::put('/{id}/update', 'update');
            Route::delete('/{id}/delete', 'delete');
        });
    });
});
