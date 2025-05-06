<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }


    // register form
    public function registerForm()
    {
        return view('auth.register');
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

            $validasi['role'] = 'user';
            $validasi['password'] = Hash::make($validasi['password']);

            User::create($validasi);

            return redirect()->route('login')->with('success', 'User berhasil ditambahkan.');
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

            return redirect()->route('superadmin.cafe')->with('success', 'Cafe berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan cafe');
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
                // return $request;
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
