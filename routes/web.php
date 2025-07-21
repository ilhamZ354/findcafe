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
use App\Http\Controllers\RatingReviewController;
use App\Http\Middleware\IsSuperAdmin;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\IsCafe;

// ============AUTH===========
Route::get('/', [CafeController::class, 'listCafes'])->name('home');
Route::get('/login', [AuthController::class, 'index'])->name('login');
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
        Route::middleware(IsSuperAdmin::class)->group(function () {
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
        });

        // ============= CAFE ===========
        Route::middleware(IsCafe::class)->group(function () {
            // untuk data detail cafe
            Route::post('/cafe', [CafeController::class, 'store'])->name('cafe.store');
            Route::get('/cafe/data-cafe', [CafeController::class, 'index'])->name('cafe.data-cafe');
            Route::put('/cafe/update/{id}', [CafeController::class, 'update'])->name('cafe.update');
            // untuk data menu
            Route::get('/cafe/menu', [MenuController::class, 'listMenuCafe'])->name('cafe.menu');
            Route::post('/cafe/menu', [MenuController::class, 'store'])->name('cafe.menu.store');
            Route::get('/cafe/menu/edit/{id}', [MenuController::class, 'show'])->name('cafe.menu.edit');
            Route::put('/cafe/menu/update/{id}', [MenuController::class, 'update'])->name('cafe.menu.update');
            Route::delete('/cafe/menu/delete/{id}', [MenuController::class, 'destroy'])->name('cafe.menu.delete');
            // untuk data transaksi
            Route::get('/cafe/transaksi', [TransactionController::class, 'listTransactionForCafe'])->name('cafe.transaksi');
            Route::post('/cafe/transaksi', [TransactionController::class, 'storeTransaksiCafe'])->name('cafe.transaksi.store');
            Route::delete('/cafe/transaksi/delete/{id}', [TransactionController::class, 'destroyTransaksiCafe'])->name('cafe.transaksi.delete');
            Route::put('/cafe/transaksi/finish/{id}', [TransactionController::class, 'finishTransaksi'])->name('cafe.transaksi.finish');
            // chat di cafe
            Route::get('/cafe/list-chat', [ChatController::class, 'listChat'])->name('cafe.list-chat');
            Route::get('/cafe/chat-cafe/{toUserId}', [ChatController::class, 'chatCafe'])->name('cafe.chat');
        });

        // =============USER===========
        Route::middleware(IsUser::class)->group(function () {
            // Route::get('/home', [CafeController::class, 'listCafes'])->name('home');
            Route::get('/detail-cafe/{id}', [CafeController::class, 'show'])->name('detail-cafe');
            Route::post('/detail-cafe/booking/{id}', [TransactionController::class, 'storeTransaksi'])->name('store-transaksi');
            // untuk transaksi dan rating review
            Route::get('/transaksi', [TransactionController::class, 'listTransactionForUser'])->name('transaksi-user');
            Route::get('/transaksi/detail/{id}', [TransactionController::class, 'detailTransaksi'])->name('transaksi-user.detail');
            Route::put('/transaksi/{id}', [TransactionController::class, 'updateTransaksi'])->name('transaksi-user.update');
            Route::put('/transaksi/pay/status', [TransactionController::class, 'updateStatusTransaksi'])->name('transaksi-user.update-status');
            Route::put('/transaksi/cancel/{id}', [TransactionController::class, 'cancelTransaksi'])->name('transaksi-user.cancel');
            Route::post('/transaksi/rating-review/{cafe_id}', [RatingReviewController::class, 'store'])->name('rating-review.store');
            // untuk list menu di user
            Route::get('/menu-cafe/{id}', [MenuController::class, 'listMenuUser'])->name('menu-cafe');
            // bookmarks
            Route::get('/bookmark', [CafeController::class, 'listBookmark'])->name('bookmarks');
            Route::post('/bookmark/{cafe_id}', [CafeController::class, 'storeToBookmark'])->name('bookmark.store');
            // profile
            Route::get('/profile/{id}', function ($id) {
                return view('pages.profile', compact('id'));
            })->name('profile');
            // chat
            Route::get('/chat-cafe/{toUserId}', [ChatController::class, 'chatUser'])->name('chat-cafe');
        });
    }
);
