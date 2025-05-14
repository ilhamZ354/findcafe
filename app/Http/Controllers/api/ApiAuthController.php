<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
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
