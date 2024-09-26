<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\Master\ProductController;
use App\Http\Controllers\Admin\Master\SupplierController;

// Route
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'auth_login']);

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'auth_register']);

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'useradmin']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('supplier', SupplierController::class);

        Route::resource('transaksi', TransaksiController::class);

        Route::get('/create-transaksi', [TransaksiController::class, 'create'])->name('create-transaksi');
        Route::get('/get-products/{supplier_id}', [TransaksiController::class, 'getProductsBySupplier']);
    });
});
