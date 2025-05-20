<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\MidtransService;

class TransactionController extends Controller
{
    // view transaksi untuk superadmin
    public function index()
    {
        $transactions = Transaction::with(['user', 'cafe'])->get();

        return view('superadmin.transaksi', compact('transactions'));
    }

    // list transaksi untuk cafe
    public function listTransactionForCafe()
    {
        $transactions = Transaction::where('cafe_id', Auth::id())->get();
        $users = User::where('role', 'user')->get();
        return view('cafe.transaksi', [
            'transactions' => $transactions,
            'users' => $users,
        ]);
    }

    // list transaksi untuk user
    public function listTransactionForUser()
    {
        $transactions = DB::table('transactions')
            ->join('pembayarans', 'transactions.id', '=', 'pembayarans.transaksi_id')
            ->where('transactions.id', Auth::id())
            ->select(
                'transactions.*',
                'pembayarans.*',
            )->get();

        return view('user.cafe.transaksi', compact('transactions'));
    }

    // store transaksi untuk user
    public function storeTransaksi(MidtransService $midtransService, Request $request, $cafe)
    {
        try {
            $query = $request->all();
            unset($query['nominal_display']);

            DB::beginTransaction();

            $validasi = Validator::make($query, [
                'name' => ['required', 'string', 'max:255'],
                'catatan' => ['nullable', 'string'],
                'nominal' => ['required', 'numeric', 'min:0'],
            ])->validate();

            $transaksi_id = 'TFX' . mt_rand(1000, 9999) . time();

            $transaksi = Transaction::create([
                'user_id' => Auth::id(),
                'cafe_id' => $cafe,
                'transaksi_id' => $transaksi_id,
                'name' => $validasi['name'],
                'catatan' => $validasi['catatan'],
                'nominal' => $validasi['nominal'] ?? null,
                'tgl_booking' => now(),
                'status' => "unpaid",
            ]);

            $snapToken = $midtransService->createSnapToken($transaksi->id);

            Pembayaran::create([
                'transaksi_id' => $transaksi->id,
                'snap_token' => $snapToken,
                'expired_at' => now()->addHours(24),
                'paid_at' => null,
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()->route('transaksi-user')->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan transaksi.');
        }
    }

    // view edit transaksi
    public function edit($id)
    {
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
            $transaction->update($validasi);
            DB::commit();

            return redirect()->route('transaksi-user')->with('success', 'Transaksi berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    }

    // delete transaksi
    public function deleteTransaksi($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            return redirect()->route('superadmin.transaksi')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus transaksi.' . $e->getMessage());
        }
    }

    public function storeTransaksiCafe(Request $request)
    {
        try {
            $validasi = $request->validate([
                'user_id' => ['nullable', 'exists:users,id'],
                'catatan' => ['nullable', 'string'],
                'nominal' => ['required', 'numeric', 'min:0'],
                'tgl_booking' => ['required', 'date'],
                'status' => ['required', 'in:unpaid,paid,failed'],
                'snap_token' => ['nullable', 'string'],
                'expired_at' => ['nullable', 'date'],
                'paid_at' => ['nullable', 'date'],
            ]);

            $user = User::find($validasi['user_id']);
            $validasi['name'] = $user->name;

            $validasi['cafe_id'] = Auth::id();
            $validasi['transaksi_id'] = 'TFX' . mt_rand(1000, 9999) . time();

            DB::beginTransaction();

            $transaction = Transaction::create($validasi);

            Pembayaran::create([
                'transaksi_id' => $transaction->id,
                'snap_token' => $request->input('snap_token'),
                'expired_at' => $request->input('expired_at'),
                'paid_at' => $validasi['status'] === 'paid' ? ($request->input('paid_at') ?: now()) : null,
                'amount' => $validasi['nominal'],
                'payment_method' => 'manual',
                'status' => $validasi['status'] === 'paid' ? 'completed' : ($validasi['status'] === 'failed' ? 'failed' : 'pending'),
            ]);

            DB::commit();

            return redirect()->route('cafe.transaksi')->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan transaksi.');
        }
    }

    public function editTransaksiCafe($id)
    {
        $transactions = Transaction::where('cafe_id', Auth::id())->get();
        $transaction = $transactions->find($id);
        $users = User::where('role', 'user')->get();
        $payment = Pembayaran::where('transaksi_id', $id)->first();

        return view('cafe.transaksi', compact('transactions', 'transaction', 'users', 'payment'))->with('showModalEdit', true);
    }

    public function updateTransaksiCafe(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'catatan' => ['nullable', 'string'],
                'nominal' => ['required', 'numeric', 'min:0'],
                'tgl_booking' => ['required', 'date'],
                'status' => ['required', 'in:unpaid,paid,failed'],
                'snap_token' => ['nullable', 'string'],
                'expired_at' => ['nullable', 'date'],
                'paid_at' => ['nullable', 'date'],
            ]);

            DB::beginTransaction();

            $transaction = Transaction::findOrFail($id);
            $transaction->update($validatedData);

            Pembayaran::updateOrCreate(
                ['transaksi_id' => $id],
                [
                    'snap_token' => $request->input('snap_token'),
                    'expired_at' => $request->input('expired_at'),
                    'paid_at' => $validatedData['status'] === 'paid' ? ($request->input('paid_at') ?: now()) : null,
                    'amount' => $validatedData['nominal'],
                    'payment_method' => 'manual',
                    'status' => $validatedData['status'] === 'paid' ? 'completed' : ($validatedData['status'] === 'failed' ? 'failed' : 'pending'),
                ],
            );

            DB::commit();
            return redirect()->route('cafe.transaksi')->with('success', 'Transaksi berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Transaksi gagal diperbarui: ' . $e->getMessage());
        }
    }

    public function destroyTransaksiCafe($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);

            Pembayaran::where('transaksi_id', $id)->delete();
            $transaction->delete();

            return redirect()->route('cafe.transaksi')->with('success', 'Transaksi berhasil dihapus');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    }
}
