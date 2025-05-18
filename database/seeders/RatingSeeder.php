<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RatingReview;
use App\Models\User;
use App\Models\CafeDetail;

class RatingSeeder extends Seeder
{
    public function run()
    {
        $cafeUsers = User::where('role', 'cafe')->get();
        $regularUsers = User::where('role', 'user')->get();

        $reviewTemplates = [
            [
                'rating' => 5,
                'review' => 'Kopi di sini sangat enak! Tempatnya juga nyaman untuk kerja.',
            ],
            [
                'rating' => 4,
                'review' => 'Menu makanannya enak, tapi sedikit mahal untuk porsinya.',
            ],
            [
                'rating' => 5,
                'review' => 'Tempat favorit untuk nongkrong dan meeting. Wifinya kencang!',
            ],
            [
                'rating' => 3,
                'review' => 'Kopinya enak tapi tempat terlalu ramai dan berisik.',
            ],
            [
                'rating' => 5,
                'review' => 'Pelayanannya ramah dan tempatnya bersih. Recommended!',
            ],
            [
                'rating' => 4,
                'review' => 'Suasana cafe cozy, cocok untuk kerja atau ngobrol santai.',
            ],
            [
                'rating' => 2,
                'review' => 'Pesanan lama datangnya dan kopi terlalu pahit.',
            ],
            [
                'rating' => 4,
                'review' => 'Menu variatif dan harga terjangkau. Saya akan datang lagi.',
            ],
        ];

        $ratingsCreated = 0;

        foreach ($cafeUsers as $cafe) {
            $cafeDetail = CafeDetail::where('cafe_id', $cafe->id)->first();
            $cafeName = $cafeDetail ? $cafeDetail->nama_cafe : $cafe->username;

            foreach ($regularUsers as $user) {
                $reviewTemplate = $reviewTemplates[array_rand($reviewTemplates)];

                if (rand(0, 1) && $cafeName) {
                    $reviewTemplate['review'] = str_replace(['di sini', 'tempat', 'Tempat'], ["di $cafeName", "$cafeName", $cafeName], $reviewTemplate['review']);
                }

                RatingReview::create([
                    'cafe_id' => $cafe->id,
                    'user_id' => $user->id,
                    'rating' => $reviewTemplate['rating'],
                    'review' => $reviewTemplate['review'],
                    'created_at' => now()->subDays(rand(1, 60)),
                    'updated_at' => now(),
                ]);

                $ratingsCreated++;
            }
        }
    }
}
