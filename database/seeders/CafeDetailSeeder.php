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
            'cafe_id' => 1, // for testing, change based on data id at users for role cafe
            'address' => 'Jl. Sudirman No. 123, Jakarta',
            'image_profile' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?q=80&w=2047&auto=format&fit=crop',
            'description' => 'Tempat nongkrong nyaman dengan berbagai pilihan menu.',
            'galleries' => json_encode([
                'https://images.unsplash.com/photo-1453614512568-c4024d13c247?q=80&w=1932&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1445116572660-236099ec97a0?q=80&w=2071&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?q=80&w=1978&auto=format&fit=crop',
            ]),
            'location' => '-6.200000, 106.816666',
        ]);
    }
}
