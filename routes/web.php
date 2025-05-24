<?php

use App\Http\Livewire\ChatRoom;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\ChatController;
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

        // ============ SUPER ADMIN ===========
        // untuk data users
        Route::get('/superadmin/users', [UserController::class, 'listUsers'])->name('superadmin.users');
        Route::get('/superadmin/user/edit/{id}', [UserController::class, 'editUser'])->name('superadmin.user.edit');
        Route::put('/superadmin/user/update/{id}', [UserController::class, 'updateUser'])->name('superadmin.user.update');
        Route::delete('/superadmin/delete-user/{id}', [UserController::class, 'deleteUser'])->name('superadmin.user.delete');
        // untuk data cafe
        Route::get('/superadmin/cafes', [UserController::class, 'listCafe'])->name('superadmin.cafe');
        Route::post('/superadmin/cafe', [UserController::class, 'storeCafe'])->name('superadmin.cafe.store');
        Route::get('/superadmin/cafe/edit/{id}', [UserController::class, 'editCafe'])->name('superadmin.cafe.edit');
        Route::put('/superadmin/cafe/update/{id}', [UserController::class, 'updateCafe'])->name('superadmin.cafe.update');
        Route::delete('/superadmin/cafe/delete/{id}', [UserController::class, 'deleteCafe'])->name('superadmin.cafe.delete');
        // untuk data transaksi
        Route::get('/superadmin/transaksi', [TransactionController::class, 'index'])->name('superadmin.transaksi');
        Route::get('/superadmin/transaksi/edit/{id}', [TransactionController::class, 'editTransaksi'])->name('superadmin.transaksi.edit');
        Route::delete('/superadmin/transaksi/delete/{id}', [TransactionController::class, 'deleteTransaksi'])->name('superadmin.transaksi.delete');

        // ============= CAFE ===========
        // untuk data cafe
        Route::post('/cafe', [CafeController::class, 'store'])->name('cafe.store');
        Route::get('/cafe/data-cafe', [CafeController::class, 'index'])->name('cafe.data-cafe');
        Route::put('/cafe/update/{id}', [CafeController::class, 'update'])->name('cafe.update');
        // menu
        Route::get('/cafe/menu', [MenuController::class, 'listMenuCafe'])->name('cafe.menu');
        Route::post('/cafe/menu', [MenuController::class, 'store'])->name('cafe.menu.store');
        Route::get('/cafe/menu/edit/{id}', [MenuController::class, 'show'])->name('cafe.menu.edit');
        Route::put('/cafe/menu/update/{id}', [MenuController::class, 'update'])->name('cafe.menu.update');
        Route::delete('/cafe/menu/delete/{id}', [MenuController::class, 'destroy'])->name('cafe.menu.delete');
        // transaksi
        Route::get('/cafe/transaksi', [TransactionController::class, 'listTransactionForCafe'])->name('cafe.transaksi');
        Route::post('/cafe/transaksis', [TransactionController::class, 'storeTransaksiCafe'])->name('cafe.transaksi.store');
        Route::get('/cafe/transaksi/edit/{id}', [TransactionController::class, 'editTransaksiCafe'])->name('cafe.transaksi.editTC');
        Route::put('/cafe/transaksi/update/{id}', [TransactionController::class, 'updateTransaksiCafe'])->name('cafe.transaksi.updateTC');
        Route::delete('/cafe/transaksi/delete/{id}', [TransactionController::class, 'destroyTransaksiCafe'])->name('cafe.transaksi.deleteTC');
        // chat
        Route::get('/cafe/list-chat', [ChatController::class, 'listChat'])->name('cafe.list-chat');
        Route::get('/cafe/chat-cafe/{toUserId}', [ChatController::class, 'chatCafe'])->name('cafe.chat');

        // =============USER===========
        Route::get('/home', [CafeController::class, 'listCafes'])->name('home');
        Route::get('/detail-cafe/{id}', [CafeController::class, 'show'])->name('detail-cafe');
        Route::post('/detail-cafe/booking/{id}', [TransactionController::class, 'storeTransaksi'])->name('store-transaksi');
        Route::get('/transaksi', [TransactionController::class, 'listTransactionForUser'])->name('transaksi-user');
        Route::put('/transaksi/{id}', [TransactionController::class, 'updateTransaksi'])->name('transaksi-user.update');
        Route::put('transaksi/pay/status', [TransactionController::class, 'updateStatusTransaksi'])->name('transaksi-user.update-status');
        Route::put('transaksi/cancel/{id}', [TransactionController::class, 'cancelTransaksi'])->name('transaksi-user.cancel');
        // Route::post('/payment/midtrans-callback', [App\Http\Controllers\PaymentController::class, 'midtransCallback']);
        Route::get('/menu-cafe/{id}', [MenuController::class, 'listMenuUser'])->name('menu-cafe');
        Route::get('/bookmark/{id}', function ($id) {
            return view('pages.bookmark', compact('id'));
        })->name('bookmark');
        Route::get('/profile/{id}', function ($id) {
            return view('pages.profile', compact('id'));
        })->name('profile');
        // chat
        Route::get('/chat-cafe/{toUserId}', [ChatController::class, 'chatUser'])->name('chat-cafe');
    }
);
