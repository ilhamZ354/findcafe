<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\CafeDetail;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cafe = CafeDetail::first();

        $menus = [
            [
                'cafe_id' => $cafe->id,
                'name' => 'Chicken Sandwich',
                'image' => 'https://images.unsplash.com/photo-1606755962773-d324e0a13086?q=80&w=500',
                'type' => 'makanan',
                'description' => 'Grilled chicken sandwich with lettuce and mayo.',
                'harga' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cafe_id' => $cafe->id,
                'name' => 'Cappuccino',
                'image' => 'https://images.unsplash.com/photo-1534778101976-62847782c213?q=80&w=500',
                'type' => 'minuman',
                'description' => 'Espresso with steamed milk and foam.',
                'harga' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cafe_id' => $cafe->id,
                'name' => 'Chocolate Cake',
                'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=500',
                'type' => 'makanan',
                'description' => 'Rich chocolate cake with chocolate ganache.',
                'harga' => 45000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cafe_id' => $cafe->id,
                'name' => 'Iced Latte',
                'image' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?q=80&w=500',
                'type' => 'minuman',
                'description' => 'Chilled espresso with milk and ice.',
                'harga' => 38000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
