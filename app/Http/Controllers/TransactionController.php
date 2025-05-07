<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(){
        // ambil semua data transaksi
        $users = User::where('role', 'user')->get();
        $cafes = User::where('role', 'cafe')->get();
        $transactions = Transaction::all();
    
        // kembalikan ke view
        return view('superadmin.transaksi', compact('users', 'cafes', 'transactions'));
    }

    public function listTransaction(){
        // ambil data transaksi dari cafe
        $transactions = Transaction::where('cafe_id', Auth::id())->get();
        // kembalikan ke view
        return view('cafe.transaksi', compact('transactions'));
    }

    public function storeTransaksi(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cafe_id' => 'required|exists:users,id,role,cafe',
            'name' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'nominal' => 'required|numeric|min:0',
            'tgl_booking' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled',
            'snap_token' => 'nullable|string',
        ]);
    
        try {
            $cafeDetail = \DB::table('cafe_details')->where('cafe_id', $request->cafe_id)->first();
            
            if (!$cafeDetail) {
                return redirect()->back()->withInput()->with('error', 'Cafe details not found for the selected cafe.');
            }
    
            Transaction::create([
                'user_id' => $request->user_id,
                'cafe_id' => $cafeDetail->id,
                'name' => $request->name,
                'catatan' => $request->catatan,
                'nominal' => $request->nominal,
                'tgl_booking' => $request->tgl_booking,
                'status' => $request->status,
                'snap_token' => $request->snap_token,
            ]);
    
            return redirect()->route('superadmin.transaksi')->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan transaksi.');
        }
    }

    public function editTransaksi($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $users = User::where('role', 'user')->get();
            $cafes = User::where('role', 'cafe')->get();
            
            // search cafe (| transaction.cafe_id 👉 (cafe_details.id) 👉 cafe_details.cafe_id 👉 (users.id) |)
            $cafeUser = \DB::table('cafe_details')
                ->join('users', 'cafe_details.cafe_id', '=', 'users.id')
                ->where('cafe_details.id', $transaction->cafe_id)
                ->select('users.id')
                ->first();
                
            if ($cafeUser) {
                $transaction->cafe_user_id = $cafeUser->id;
            }
    
            return view('superadmin.transaksi', [
                'transactions' => Transaction::all(),
                'users' => $users,
                'cafes' => $cafes,
                'editTransaction' => $transaction,
                'showEditModal' => true
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('superadmin.transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }
    }
    

    public function updateTransaksi(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cafe_id' => 'required|exists:users,id,role,cafe',
            'name' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'nominal' => 'required|numeric|min:0',
            'tgl_booking' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled',
            'snap_token' => 'nullable|string',
        ]);

        try {
            $transaction = Transaction::findOrFail($id);

            $cafeDetail = \DB::table('cafe_details')->where('cafe_id', $request->cafe_id)->first();

            if (!$cafeDetail) {
                return redirect()->back()->withInput()->with('error', 'Cafe details not found for the selected cafe.');
            }

            $transaction->update([
                'user_id' => $request->user_id,
                'cafe_id' => $cafeDetail->id,
                'name' => $request->name,
                'catatan' => $request->catatan,
                'nominal' => $request->nominal,
                'tgl_booking' => $request->tgl_booking,
                'status' => $request->status,
                'snap_token' => $request->snap_token,
            ]);

            return redirect()->route('superadmin.transaksi')->with('success', 'Transaksi berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui transaksi: ' . $e->getMessage());
        }
    }

    public function deleteTransaksi($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            return redirect()->route('superadmin.transaksi')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus transaksi.');
        }
    }
}
