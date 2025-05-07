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
            $cafeDetail = \DB::table('cafe_details')->where('capfe_id', $request->cafe_id)->first();
            
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
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan transaksi: ' . $e->getMessage());
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
