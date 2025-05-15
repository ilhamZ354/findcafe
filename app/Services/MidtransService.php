<?php

namespace App\Services;

use App\Models\Transaction;
use Exception;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class MidtransService
{
    protected string $serverKey;
    protected string $isProduction;
    protected string $isSanitized;
    protected string $is3ds;

    /**
     * MidtransService constructor.
     *
     * Menyiapkan konfigurasi Midtrans berdasarkan pengaturan yang ada di file konfigurasi.
     */
    public function __construct()
    {
        // Konfigurasi server key, environment, dan lainnya
        $this->serverKey = config('midtrans.server_key');
        $this->isProduction = config('midtrans.is_production');
        $this->isSanitized = config('midtrans.is_sanitized');
        $this->is3ds = config('midtrans.is_3ds');

        // Mengatur konfigurasi global Midtrans
        Config::$serverKey = $this->serverKey;
        Config::$isProduction = $this->isProduction;
        Config::$isSanitized = $this->isSanitized;
        Config::$is3ds = $this->is3ds;
    }

    /**
     * Membuat snap token untuk transaksi berdasarkan data order.
     *
     * @param Transaction $order Objek order yang berisi informasi transaksi.
     *
     * @return string Snap token yang dapat digunakan di front-end untuk proses pembayaran.
     * @throws Exception Jika terjadi kesalahan saat menghasilkan snap token.
     */

    public function createSnapToken($transaksiId)
    {
        $transaksi = Transaction::findOrFail($transaksiId);

        $params = [
            'transaction_details' => [
                'order_id' => $transaksi->transaksi_id,
                'gross_amount' => $transaksi->nominal,
            ],
            'customer_details' => [
                'first_name' => $transaksi->name,
            ]
        ];

        try {
            return Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal update cafe: '. $e->getMessage());
        }
    }


    /**
     * Memvalidasi apakah signature key yang diterima dari Midtrans sesuai dengan signature key yang dihitung di server.
     *
     * @return bool Status apakah signature key valid atau tidak.
     */
    public function isSignatureKeyVerified(): bool
    {
        $notification = new Notification();

        // Membuat signature key lokal dari data notifikasi
        $localSignatureKey = hash('sha512',
            $notification->transaksi_id . $notification->status_code .
            $notification->gross_amount . $this->serverKey);

        // Memeriksa apakah signature key valid
        return $localSignatureKey === $notification->signature_key;
    }

    /**
     * Mendapatkan data order berdasarkan transaksi_id yang ada di notifikasi Midtrans.
     *
     * @return Order Objek order yang sesuai dengan transaksi_id yang diterima.
     */
    public function getOrder(): Transaction
    {
        $notification = new Notification();

        // Mengambil data order dari database berdasarkan transaksi_id
        return Transaction::where('transaksi_id', $notification->transaksi_id)->first();
    }

    /**
     * Mendapatkan status transaksi berdasarkan status yang diterima dari notifikasi Midtrans.
     *
     * @return string Status transaksi ('success', 'pending', 'expire', 'cancel', 'failed').
     */
    public function getStatus(): string
    {
        $notification = new Notification();
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;

        return match ($transactionStatus) {
            'capture' => ($fraudStatus == 'accept') ? 'success' : 'pending',
            'settlement' => 'success',
            'deny' => 'failed',
            'cancel' => 'cancel',
            'expire' => 'expire',
            'pending' => 'pending',
            default => 'unknown',
        };
    }

    /**
     * Memetakan item dalam order menjadi format yang dibutuhkan oleh Midtrans.
     *
     * @param Order $order Objek order yang berisi daftar item.
     * @return array Daftar item yang dipetakan dalam format yang sesuai.
     */
    // protected function mapItemsToDetails(Transaction $order): array
    // {
    //     return $order->items()->get()->map(function ($item) {
    //         return [
    //             'id' => $item->id,
    //             'nominal' => $item->nominal,
    //             'name' => $item->name,
    //         ];
    //     })->toArray();
    // }

    /**
     * Mendapatkan informasi customer dari order.
     * Data ini dapat diambil dari relasi dengan tabel lain seperti users atau tabel khusus customer.
     *
     * @param Transaction $order Objek order yang berisi informasi tentang customer.
     * @return array Data customer yang akan dikirim ke Midtrans.
     */
    protected function getCustomerDetails(Transaction $transaksi): array
    {
        // Sesuaikan data customer dengan informasi yang dimiliki oleh aplikasi Anda
        return [
            'name' => $transaksi->name, // Ganti dengan data nyata
            'catatan' => $transaksi->catatan, // Ganti dengan data nyata
            'tgl_booking' => $transaksi->tgl_booking, // Ganti dengan data nyata
        ];
    }
}
