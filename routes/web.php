<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'auth_login']);

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'auth_register']);

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'useradmin']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class);
    });
});
