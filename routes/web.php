<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CafeController;


// ============AUTH===========
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegis'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ================WITH LOGIN================
Route::middleware('auth')->group(
    function () {

        Route::get('/dashboard', function () {
            return view('dashboard.index');
        })->name('dashboard');
        Route::post('/upload', [UploadController::class, 'store'])->name('upload');


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
        Route::get('/cafe/data-cafe', [CafeController::class, 'index'])->name('cafe.data-cafe');
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
