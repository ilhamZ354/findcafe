<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // view transaksi untuk superadmin
    public function index(){
        // ambil semua data transaksi
        $transactions = Transaction::all();

        // kembalikan ke view
        return view('superadmin.transaksi', compact('transactions'));
    }

    // list transaksi untuk cafe
    public function listTransactionForCafe(){
        // ambil data transaksi dari cafe
        $transactions = Transaction::where('cafe_id', Auth::id())->get();
        // kembalikan ke view
        return view('cafe.transaksi', compact('transactions'));
    }

    // list transaksi untuk user
    public function listTransactionForUser(){
        // ambil data transaksi dari cafe
        $transactions = Transaction::where('user_id', Auth::id())->get();
        // kembalikan ke view
        return view('user.cafe.transaksi', compact('transactions'));
    }

    // store transaksi untuk user
    public function storeTransaksi(Request $request, $cafe)
    {

        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'catatan' => ['nullable', 'string'],
                'nominal' => ['required', 'min:0'],
                'tgl_booking' => ['required', 'date'],
            ]);

            $transaksi_id = 'TFX' . mt_rand(1000, 9999) . time();

            DB::beginTransaction();

            Transaction::create([
                'user_id' => Auth::id(),
                'cafe_id' => $cafe,
                'transaksi_id' => $transaksi_id,
                'name' => $request->name,
                'catatan' => $request->catatan,
                'nominal' => $request->nominal,
                'status' => "unpaid",
            ]);

            return redirect()->route('user.transaksi')->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan transaksi.');
        }
    }

    // view edit transaksi
    public function edit($id){
        $transaction = Transaction::findOrFail($id);

        return view('user.transaksi', [
            'transaksi' => $transaction,
            'showEditModal' => true,
        ]);
    }

    // update transaksi untuk user
    public function updateTransaksi(Request $request, $id)
    {
        try {

            $validasi = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'catatan' => ['nullable', 'string'],
                'nominal' => ['required', 'min:0'],
                'tgl_booking' => ['required', 'date'],
            ]);

            $transaction = Transaction::findOrFail($id);

            DB::beginTransaction();

            $transaction::update($validasi);

            return view('user.cafe.transaksi');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    }

    public function deleteTransaksi($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            return redirect()->route('user.transaksi')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus transaksi.');
        }
    }
}
