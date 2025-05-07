<?php

namespace Database\Seeders;

use App\Models\CafeDetail;
use Illuminate\Database\Seeder;

class CafeDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CafeDetail::create([
            'cafe_id' => 3, // for testing, change based on data id at users for role cafe
            'address' => 'Jl. Sudirman No. 123, Jakarta',
            'image_profile' => 'images/cafes/profile1.jpg',
            'description' => 'Tempat nongkrong nyaman dengan berbagai pilihan menu.',
            'galleries' => json_encode([
                'images/cafes/gallery1.jpg',
                'images/cafes/gallery2.jpg',
                'images/cafes/gallery3.jpg',
            ]),
            'location' => '-6.200000, 106.816666',
        ]);
    }
}
