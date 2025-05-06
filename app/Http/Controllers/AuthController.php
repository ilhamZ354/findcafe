<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function loginForm()
    {
        return view('pages.login.index');
    }

    // register form
    public function registerForm()
    {
        return view('pages.register.index');
    }

    // store registrasi
    public function storeRegis(Request $request)
    {
        try {
            $validasi = $request->validate([
                'username' => 'required|string|unique:users,username',
                'email' => 'required|string|email|unique:users,email',
                'role' => 'required|in:user,cafe',
                'no_wa' => 'required|string|min:11',
                'password' => 'required|string|min:8',
            ]);

            $validasi['password'] = Hash::make($validasi['password']);

            User::create($validasi);

            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user');
        }
    }

    // store akun cafe
    public function storeCafe(Request $request)
    {
        try {
            $validasi = $request->validate([
                'username' => 'required|string|unique:users,username',
                'email' => 'required|string|email|unique:users,email',
                'role' => 'required|in:user,cafe',
                'no_wa' => 'required|string|min:11',
                'password' => 'required|string|min:8',
            ]);

            $validasi['role'] = 'cafe';
            $validasi['password'] = Hash::make($validasi['password']);

            User::create($validasi);

            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user');
        }
    }


    // Proses login
    public function login(Request $request)
    {
        try {
            // dd($request->all());
            $credentials = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return $request;
                return redirect()->intended('/dashboard')->with('success', 'Login berhasil.');
            }

            return redirect()->route('login')->withInput()->with('error', 'Email atau password salah.');
        } catch (\Exception $e) {
            return redirect()->route('login')->withInput()->with('error', 'Email atau password salah.');
        }
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}
