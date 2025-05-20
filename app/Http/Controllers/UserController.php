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
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'role' => 'required|in:user,cafe',
                'no_wa' => 'required|string|min:11',
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|min:8|same:password',
            ]);

            // bersihkan confirm password
            unset($validasi['confirm_password']);

            $validasi['role'] = 'user';
            $validasi['password'] = Hash::make($validasi['password']);

            User::create($validasi);

            return redirect()->route('login')->with('success', 'User berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user. ')->withErrors($e->validator);
        }
    }

    // store akun cafe
    public function storeCafe(Request $request)
    {
        try {
            $validasi = $request->validate([
                'username' => ['required', 'string', 'unique:users,username'],
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'unique:users,email'],
                'no_wa' => ['required', 'string', 'min:11'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            $validasi['role'] = 'cafe';
            $validasi['password'] = Hash::make($validasi['password']);


            User::create($validasi);

            return redirect()->route('superadmin.cafe')->with('success', 'Cafe berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan cafe' . $e->getMessage());
        }
    }

    // store akun users untuk superadmin
    public function storeUser(Request $request)
    {
        try {
            $validasi = $request->validate([
                'username' => ['required', 'string', 'unique:users,username'],
                'email' => ['required', 'string', 'email', 'unique:users,email'],
                'no_wa' => ['required', 'string', 'min:11'],
                'password' => ['required', 'string', 'min:8'],
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

    // view edit cafe untuk superadmin
    public function editCafe($id)
    {
        // ambil semua data cafe
        $cafes = User::where('role', 'cafe')->get();

        // find data cafe
        $editCafe = User::findOrFail($id);

        return view('superadmin.cafe', [
            'cafes' => $cafes,
            'editCafe' => $editCafe,
            'showEditModal' => true
        ]);
    }

    // update akun cafe untuk superadmin
    public function updateCafe(Request $request, $id)
    {
        try {
            $validasi = $request->validate([
                'username' => ['required', 'string'],
                'email' => ['required', 'string', 'email'],
                'no_wa' => ['required', 'string', 'min:11'],
            ]);

            $user = User::findOrFail($id);

            $user->update($validasi);

            return redirect()->route('superadmin.cafe')->with('success', 'Cafe berhasil diupdate.');
        } catch (\Throwable $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal update cafe')->withErrors($e->validator);
        }
    }

    // view edit user untuk superadmin
    public function editUser($id)
    {
        // ambil semua data user
        $users = User::where('role', 'user')->get();

        // find data user
        $editUser = User::findOrFail($id);

        return view('superadmin.users', [
            'users' => $users,
            'editUser' => $editUser,
            'showEditModal' => true
        ]);
    }

    // edit user untuk superadmin dan user
    public function updateUser(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'username' => ['required', 'string'],
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email'],
                'no_wa' => ['required', 'string', 'min:11'],
            ]);

            $user = User::findOrFail($id);

            $user->update($validated);

            return redirect()->route('superadmin.users')->with('success', 'User berhasil diperbarui!');
        } catch (\Throwable $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal update user')->withErrors($e->validator);
        }
    }

    // delete akun cafe untuk superadmin
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


    // delete user untuk superadmin
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
