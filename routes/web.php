<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

// ============AUTH===========
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/register', [UserController::class, 'storeRegis'])->name('register.post');


// ================WITH LOGIN================
Route::middleware('auth')->group(
    function () {

        Route::get('/dashboard', function () {
            return view('dashboard.index');
        })->name('dashboard');
        // Route::post('/upload', [UploadController::class, 'store'])->name('upload');

        // ============SUPER ADMIN===========
        Route::post('/superadmin/cafe', [UserController::class, 'storeCafe'])->name('superadmin.cafe.store');
        Route::put('/superadmin/cafe/{user}', [UserController::class, 'updateCafe'])->name('superadmin.cafe.update');
        Route::get('/superadmin/users', [UserController::class, 'listUsers'])->name('superadmin.users');
        Route::get('/superadmin/cafes', [UserController::class, 'listCafe'])->name('superadmin.cafe');
        Route::post('/superadmin/user', [UserController::class, 'storeUser'])->name('superadmin.user.store');
        Route::delete('/superadmin/delete-user/{id}', [UserController::class, 'deleteUser'])->name('superadmin.user.delete');
        Route::get('/superadmin/transaksi', [TransactionController::class, 'index'])->name('superadmin.transaksi');
        Route::post('/superadmin/cafe', [UserController::class, 'storeCafe'])->name('superadmin.cafe.store');
        Route::delete('/superadmin/delete-cafe/{id}', [UserController::class, 'deleteCafe'])->name('superadmin.cafe.delete');
        Route::get('/superadmin/transaksi', [TransactionController::class, 'index'])->name('superadmin.transaksi');

        // ============SUPER ADMIN===========
        Route::get('/superadmin/cafe', function () {
            return view('superadmin.cafe');
        })->name('superadmin.cafe');
        Route::post('/superadmin/cafe', [AuthController::class, 'storeCafe'])->name('superadmin.cafe.store');
        Route::get('/superadmin/users', function () {
            return view('superadmin.users');
        })->name('superadmin.users');
        Route::get('/superadmin/transaksi', function () {
            return view('superadmin.transaksi');
        })->name('superadmin.transaksi');

        // =============CAFE===========
        // Route::get('/cafe/data-cafe', [CafeController::class, 'index'])->name('cafe.data-cafe');
        Route::get('/cafe/data-cafe', function () {
            return view('cafe.data-cafe');
        })->name('cafe.data-cafe');
        Route::post('/cafe', [CafeController::class, 'store'])->name('cafe.store');
        Route::put('/cafe/{id}', [CafeController::class, 'update'])->name('cafe.update');
        Route::get('/cafe/menu-cafe', function () {
            return view('cafe.menu-cafe');
        })->name('cafe.menu-cafe');
        Route::get('/cafe/transaksi', function () {
            return view('cafe.transaksi');
        })->name('cafe.transaksi');
    }
);
