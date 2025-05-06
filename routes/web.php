<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CafeController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::post('/register-cafe', [AuthController::class, 'storeCafe'])->name('register.cafe');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/upload', [UploadController::class, 'store'])->name('upload');

Route::get('/cafe', [CafeController::class, 'index'])->name('cafe.index');
Route::post('/cafe', [CafeController::class, 'store'])->name('cafe.store');
Route::put('/cafe/{id}', [CafeController::class, 'update'])->name('cafe.update');
