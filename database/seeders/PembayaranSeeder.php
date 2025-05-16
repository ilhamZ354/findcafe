<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use App\Models\Transaction;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaction::pluck('id')->toArray();

        $pembayarans = [
            [
                'transaksi_id' => $transactions[0],
                'snap_token' => 'SNAP-' . md5(uniqid()),
                'expired_at' => Carbon::now()->addDays(1),
                'paid_at' => Carbon::now(),
                'status' => 'completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'transaksi_id' => $transactions[1],
                'snap_token' => 'SNAP-' . md5(uniqid()),
                'expired_at' => Carbon::now()->addDays(1),
                'paid_at' => null,
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'transaksi_id' => $transactions[2],
                'snap_token' => 'SNAP-' . md5(uniqid()),
                'expired_at' => Carbon::now()->addDays(1),
                'paid_at' => Carbon::now()->subHours(2),
                'status' => 'completed',
                'created_at' => Carbon::now()->subHours(3),
                'updated_at' => Carbon::now()->subHours(2),
            ],
        ];

        foreach ($pembayarans as $pembayaran) {
            Pembayaran::create($pembayaran);
        }
    }
}
