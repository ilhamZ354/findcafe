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
Route::get('/bookmark', function () {
    return view(view: 'bookmark.index');
})->name('index');
Route::get('/menu-cafe', action: function () {
    return view('menucafe.index');
})->name('index');
Route::get('/users', function () {
    return view(view: 'users.index');
})->name('index');
