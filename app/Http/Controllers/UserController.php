<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

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

    // store akun users
    public function storeUser(Request $request)
    {
        try {
            $validasi = $request->validate([
                'username' => 'required|string|unique:users,username',
                'email' => 'required|string|email|unique:users,email',
                'role' => 'required|in:user',
                'no_wa' => 'required|string|min:11',
                'password' => 'required|string|min:8',
            ]);

            $validasi['role'] = 'user';
            $validasi['password'] = Hash::make($validasi['password']);

            User::create($validasi);

            return redirect()->route('superadmin.users')->with('success', 'User berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user');
        }
    }

    // get users role user
    public function listUsers(Request $request)
    {
        // ambil semua data user
        $users = User::where('role', 'user')->get();

        // kembalikan ke view
        return view('superadmin.users', compact('users'));
    }

    // get users role cafe
    public function listCafe(Request $request)
    {
        // ambil semua data cafe
        $cafe = User::where('role', 'cafe')->get();

        // kembalikan ke view
        return view('superadmin.cafe', compact('cafe'));
    }

    // update akun cafe
    // store akun cafe
    public function updateCafe(Request $request, User $user)
    {
        try {
            $validasi = $request->validate([
                'username' => 'required|string|unique:users,username',
                'email' => 'required|string|email|unique:users,email',
                'role' => 'required|in:user,cafe',
                'no_wa' => 'required|string|min:11',
            ]);

            $validasi['role'] = 'cafe';

            $user->update($validasi);

            return redirect()->route('superadmin.cafes')->with('success', 'Cafe berhasil diupdate.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal update cafe');
        }
    }

    public function deleteCafe($id)
    {
        try {
            $cafe = User::findOrFail($id);
            $cafe->delete();

            return redirect()->route('superadmin.cafe')->with('success', 'Cafe berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus cafe.');
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('superadmin.users')->with('success', 'User berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus user.');
        }
    }

}
