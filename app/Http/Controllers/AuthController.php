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


    // Proses login
    public function login(Request $request)
    {
        try {
            // dd($request->all());
            $credentials = $request->validate([
                'email' => ['required','string'],
                'password' => ['required','string'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                // user
                if (Auth::user()->role == 'user') {
                    return redirect()->route('home');
                } else {
                    return redirect()->route('dashboard');
                }
            }

            return redirect()->route('login')->withInput()->withInput()->with('error', 'Email atau password salah');
        } catch (\Exception $e) {
            return redirect()->route('login')->withInput()->with('error', 'Email atau password salah');
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
