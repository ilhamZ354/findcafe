<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\ApiUserController;

Route::post('/upload', [UploadController::class, 'store']);

// ============AUTH===========
Route::get('/', [ApiAuthController::class, 'index'])->name('login');
Route::post('/login', [ApiAuthController::class, 'login'])->name('login.post');
// Route::get('/register', [ApiAuthController::class, 'registerForm'])->name('register');
Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout');

Route::post('/register', [ApiUserController::class, 'storeUser'])->name('register.post');
Route::post('/cafe/create', [ApiUserController::class, 'storeCafe'])->name('cafe.post');

// =============TRANSAKSI UNTUK USER===========
Route::post('/user/transaksi/{cafe}', [TransaksiController::class, 'storeTransaksi'])->name('user.transaksi.store');
