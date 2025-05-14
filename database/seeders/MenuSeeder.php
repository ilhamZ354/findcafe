<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'cafe_id'    => 3,
                'name'       => 'Chicken Sandwich 3',
                'description'=> 'Grilled chicken 3 sandwich with lettuce and mayo.',
                'image'      => 'chicken_sandwich_3.jpg',
                'type'       => 'makanan',
                'price'      => 40003,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
