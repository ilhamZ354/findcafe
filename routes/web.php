<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
Route::get('/cafe', function () {
    return view(view: 'cafe.index');
})->name('index');
Route::get('/dashboard/cafe-detail', function () {
    return view(view: 'dashboard.cafe-detail');
})->name('cafe-detail');
Route::get('/dashboard/cafe-detail/menu-cafe', function () {
    return view(view: 'dashboard.menu-cafe');
})->name('cafe-detail');
Route::get('/dashboard/cafe-detail/cafe-chat', function () {
    return view(view: 'dashboard.cafe-chat');
})->name('cafe-chat');
Route::get('/bookmark', function () {
    return view(view: 'bookmark.index');
})->name('index');
Route::get('/menu-cafe', action: function () {
    return view('menucafe.index');
})->name('index');
Route::get('/users', function () {
    return view(view: 'users.index');
})->name('index');
Route::get('/profile', function () {
    return view(view: 'profile.index');
})->name('index');
