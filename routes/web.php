<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MenuController;

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

        // ============ SUPER ADMIN ===========
        Route::get('/superadmin/users', [UserController::class, 'listUsers'])->name('superadmin.users');
        Route::post('/superadmin/user', [UserController::class, 'storeUser'])->name('superadmin.user.store');
        Route::get('/superadmin/user/edit/{id}', [UserController::class, 'editUser'])->name('superadmin.user.edit');
        Route::put('/superadmin/user/update/{id}', [UserController::class, 'updateUser'])->name('superadmin.user.update');
        Route::delete('/superadmin/delete-user/{id}', [UserController::class, 'deleteUser'])->name('superadmin.user.delete');
        Route::get('/superadmin/cafes', [UserController::class, 'listCafe'])->name('superadmin.cafe');
        Route::post('/superadmin/cafe', [UserController::class, 'storeCafe'])->name('superadmin.cafe.store');
        Route::get('/superadmin/cafe/edit/{id}', [UserController::class, 'editCafe'])->name('superadmin.cafe.edit');
        Route::put('/superadmin/cafe/update/{id}', [UserController::class, 'updateCafe'])->name('superadmin.cafe.update');
        Route::delete('/superadmin/delete-cafe/{id}', [UserController::class, 'deleteCafe'])->name('superadmin.cafe.delete');
        Route::get('/superadmin/transaksi', [TransactionController::class, 'index'])->name('superadmin.transaksi');
        Route::post('/superadmin/transaksis', [TransactionController::class, 'storeTransaksi'])->name('superadmin.transaksi.store');
        Route::delete('/superadmin/delete-transaksi/{id}', [TransactionController::class, 'deleteTransaksi'])->name('superadmin.transaksi.delete');
        Route::get('/superadmin/transaksi/edit/{id}', [TransactionController::class, 'editTransaksi'])->name('superadmin.transaksi.edit');
        Route::put('/superadmin/transaksi/update/{id}', [TransactionController::class, 'updateTransaksi'])->name('superadmin.transaksi.update');
    
        // =============CAFE===========
        Route::get('/cafe/data-cafe', [CafeController::class, 'index'])->name('cafe.data-cafe');
        Route::post('/cafe', [CafeController::class, 'store'])->name('cafe.store');
        Route::put('/cafe/{id}', [CafeController::class, 'update'])->name('cafe.update');
        Route::get('/cafe/transaksi', function () {
            return view('cafe.transaksi');
        })->name('cafe.transaksi');

        // =============MENU UNTUK CAFE===========
        Route::get('/cafe/menu', [MenuController::class, 'index'])->name('cafe.menu');
        Route::post('/cafe/menu', [MenuController::class, 'store'])->name('cafe.menu.store');
        Route::get('/cafe/menu/edit/{id}', [MenuController::class, 'edit'])->name('cafe.menu.edit');
        Route::put('/cafe/menu/update/{id}', [MenuController::class, 'update'])->name('cafe.menu.update');
        Route::delete('/cafe/menu/delete/{id}', [MenuController::class, 'destroy'])->name('cafe.menu.delete');
    }
);
