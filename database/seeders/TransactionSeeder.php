<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cafeIds = User::where('role', 'cafe')->pluck('id')->toArray();
        $userIds = User::where('role', 'user')->pluck('id')->toArray();
        $userNames = User::where('role', 'user')->pluck('name', 'id')->toArray();

        $transactions = [];

        foreach (range(1, 3) as $i) {
            $userId = $userIds[array_rand($userIds)];
            $transactions[] = [
                'cafe_id' => $cafeIds[array_rand($cafeIds)],
                'user_id' => $userId,
                'transaksi_id' => 'TRX-' . Str::random(8),
                'name' => $userNames[$userId],
                'catatan' => match ($i) {
                    1 => 'Need quiet space for 5 people',
                    2 => 'Birthday celebration for 10 people',
                    3 => 'Need WiFi and power outlets',
                },
                'nominal' => match ($i) {
                    1 => 150000,
                    2 => 350000,
                    3 => 100000,
                },
                'tgl_booking' => match ($i) {
                    1 => now()->addDays(2),
                    2 => now()->addDays(5),
                    3 => now()->addDays(1),
                },
                'status' => match ($i) {
                    1 => 'unpaid',
                    2 => 'paid',
                    3 => 'failed',
                },
                'created_at' => match ($i) {
                    3 => now()->subDays(2),
                    default => now(),
                },
                'updated_at' => now(),
            ];
        }

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }
}
