<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Transaction;
use App\Services\MidtransService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    // view transaksi untuk superadmin
    public function index()
    {
        $transactions = Transaction::with(['user', 'cafe', 'payments'])->paginate(20);

        return view('superadmin.transaksi', compact('transactions'));
    }

    // list transaksi untuk cafe
    public function listTransactionForCafe()
    {
        $transactions = Transaction::where('cafe_id', Auth::id())->with(['user', 'payments'])->orderByDesc('created_at')->paginate(20);
        $users = User::where('role', 'user')->paginate(20);
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
            ->join('users', 'transactions.cafe_id', '=', 'users.id')
            ->where('transactions.user_id', Auth::id())
            ->select(
                'transactions.*',
                'pembayarans.*',
                'users.name as cafe_name',
            )
            ->orderByDesc('transactions.created_at') // Menampilkan data terbaru terlebih dahulu
            ->paginate(20);

        // dd($transactions);s

        return view('pages.transaksi', compact('transactions'));
    }


    // detail transaksi
    public function detailTransaksi($id)
    {
        $transaction = Transaction::with(['user', 'cafe', 'payments'])->findOrFail($id);
        return view('pages.transaksi-detail', compact('transaction'));
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
                'tgl_booking' => ['required'],
                'catatan' => ['nullable', 'string'],
                'nominal' => ['required', 'numeric', 'min:0'],
            ])->validate();

            $transaksi_id = 'TFX' . mt_rand(1000, 9999) . time();

            $transaksi = Transaction::create([
                'user_id' => Auth::id(),
                'cafe_id' => $cafe,
                'transaksi_id' => $transaksi_id,
                'name' => $validasi['name'],
                'catatan' => $validasi['catatan'] ?? null,
                'nominal' => $validasi['nominal'] ?? null,
                'tgl_booking' => $validasi['tgl_booking'],
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

            // return redirect()->route('transaksi-user')->with('success', 'Transaksi berhasil ditambahkan.');
            // ke detail transaksi
            return  redirect()->route('transaksi-user.detail', $transaksi->id)->with('success', 'Transaksi berhasil ditambahkan.');
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


    // public function editTransaksiCafe($id)
    // {
    //     $transactions = Transaction::where('cafe_id', Auth::id())->get();
    //     $transaction = $transactions->find($id);
    //     $users = User::where('role', 'user')->get();
    //     $payment = Pembayaran::where('transaksi_id', $id)->first();

    //     return view('cafe.transaksi', compact('transactions', 'transaction', 'users', 'payment'))->with('showModalEdit', true);
    // }

    // public function updateTransaksiCafe(Request $request, $id)
    // {
    //     try {
    //         $validatedData = $request->validate([
    //             'name' => ['required', 'string', 'max:255'],
    //             'catatan' => ['nullable', 'string'],
    //             'nominal' => ['required', 'numeric', 'min:0'],
    //             'tgl_booking' => ['required', 'date'],
    //             'status' => ['required', 'in:unpaid,paid,failed'],
    //             'snap_token' => ['nullable', 'string'],
    //             'expired_at' => ['nullable', 'date'],
    //             'paid_at' => ['nullable', 'date'],
    //         ]);

    //         DB::beginTransaction();

    //         $transaction = Transaction::findOrFail($id);
    //         $transaction->update($validatedData);

    //         Pembayaran::updateOrCreate(
    //             ['transaksi_id' => $id],
    //             [
    //                 'snap_token' => $request->input('snap_token'),
    //                 'expired_at' => $request->input('expired_at'),
    //                 'paid_at' => $validatedData['status'] === 'paid' ? ($request->input('paid_at') ?: now()) : null,
    //                 'amount' => $validatedData['nominal'],
    //                 'payment_method' => 'manual',
    //                 'status' => $validatedData['status'] === 'paid' ? 'completed' : ($validatedData['status'] === 'failed' ? 'failed' : 'pending'),
    //             ],
    //         );

    //         DB::commit();
    //         return redirect()->route('cafe.transaksi')->with('success', 'Transaksi berhasil diperbarui.');
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         return redirect()
    //             ->back()
    //             ->with('error', 'Transaksi gagal diperbarui: ' . $e->getMessage());
    //     }
    // }

    // update status transaksi
    public function updateStatusTransaksi(Request $request)
    {
        try {
            $status = $request->input('statusTransaksi');
            $result = (object) $request->input('result'); // Cast ke object biar bisa pakai ->

            $paymentStatus = 'pending';

            if ($status === 'paid') {
                $paymentStatus = 'processing';
            } elseif ($status === 'failed') {
                $paymentStatus = 'cancelled';
            }

            $transaksi_id = $result->order_id;
            $paid_at = $result->transaction_time;

            DB::beginTransaction();

            $transaksi = Transaction::where('transaksi_id', $transaksi_id)->firstOrFail();
            $transaksi->update([
                'status' => $status
            ]);

            $payment = Pembayaran::where('transaksi_id', $transaksi->id)->firstOrFail();
            $payment->update([
                'status' => $paymentStatus,
                'paid_at' => $paid_at
            ]);

            DB::commit();

            return response()->json(['message' => 'Status transaksi berhasil diperbarui.']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status transaksi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // cancel transaksi
    public function cancelTransaksi($id)
    {
        try {
            DB::beginTransaction();

            $transaksi = Transaction::where('id', $id)->firstOrFail();
            $transaksi->update([
                'status' => 'failed'
            ]);

            $payment = Pembayaran::where('transaksi_id', $id)->firstOrFail();
            $payment->update([
                'status' => 'cancelled',
            ]);

            DB::commit();
            return redirect()->to(url()->previous())->with('success', 'Transaksi berhasil dibatalkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membatalkan transaksi.');
        }
    }


    // finish transaksi
    public function finishTransaksi($id)
    {
        try {
            DB::beginTransaction();

            $payment = Pembayaran::where('transaksi_id', $id)->firstOrFail();
            $payment->update([
                'status' => 'completed',
            ]);

            DB::commit();
            return redirect()->route('cafe.transaksi')->with('success', 'Transaksi berhasil diselesaikan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyelesaikan transaksi.');
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
