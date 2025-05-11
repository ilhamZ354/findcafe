<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ApiUserController extends Controller
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
        $cafes = User::where('role', 'cafe')->get();

        // kembalikan ke view
        return view('superadmin.cafe', compact('cafes'));
    }

    public function editCafe($id)
    {
        $editCafe = User::findOrFail($id);
        return view('superadmin.cafe', [
            'cafes' => User::where('role', 'cafe')->get(),
            'editCafe' => $editCafe,
            'showEditModal' => true
        ]);
    }

    // update akun cafe
    // store akun cafe
    public function updateCafe(Request $request, $id)
    {
        try {
            $validasi = $request->validate([
                'username' => 'required|string|unique:users,username,' . $id,
                'email' => 'required|string|email|unique:users,email,' . $id,
                'no_wa' => 'required|string|min:11',
                'password' => 'nullable|string|min:6',
            ]);

            $user = User::findOrFail($id);

            $user->username = $validasi['username'];
            $user->email = $validasi['email'];
            $user->no_wa = $validasi['no_wa'];

            if (!empty($validasi['password'])) {
                $user->password = Hash::make($validasi['password']);
            }

            $user->save();

            return redirect()->route('superadmin.cafe')->with('success', 'Cafe berhasil diupdate.');
        } catch (\Throwable $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal update cafe: ')->withErrors($e->validator)->withInput();
        }
    }

    public function editUser($id)
    {
        $editUser = User::findOrFail($id);
        return view('superadmin.users', [
            'users' => User::all(),
            'editUser' => $editUser,
            'showEditModal' => true
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'no_wa' => 'required|string|min:10',
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail($id);

        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->no_wa = $validated['no_wa'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('superadmin.users')->with('success', 'User berhasil diperbarui!');
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
