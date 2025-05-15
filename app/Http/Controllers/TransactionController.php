<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Pembayaran;
use illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\MidtransService;

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
    public function storeTransaksi(MidtransService $midtransService, Request $request, $cafe)
    {

        try {

            $validasi = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'catatan' => ['nullable', 'string'],
                'nominal' => ['required', 'min:0'],
            ]);

            $transaksi_id = 'TFX' . mt_rand(1000, 9999) . time();

            DB::beginTransaction();

            $transaksi = Transaction::create([
                'user_id' => Auth::id(),
                'cafe_id' => $cafe,
                'transaksi_id' => $transaksi_id,
                'name' => $validasi['name'],
                'catatan' => $validasi['catatan'],
                'nominal' => $validasi['nominal'],
                'tgl_booking' => now(),
                'status' => "unpaid",
            ]);

            $snapToken = $midtransService->createSnapToken($transaksi->id);

            Pembayaran::create([
                'transaksi_id' => $transaksi->id,
                'snap_token' => $snapToken,
                'expired_at' => now()->addHours(24),
                'paid_at' => null,
                'status'=> 'pending',
            ]);

            DB::commit();
            
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
