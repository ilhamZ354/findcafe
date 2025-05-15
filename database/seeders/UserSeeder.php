<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'super-admin',
            'password' => bcrypt('kunci123'),
            'no_wa' => '0823211342345',
        ]);
        \App\Models\User::create([
            'username' => 'cafe',
            'name' => 'Cafe Jalan',
            'email' => 'cafe@gmail.com',
            'role' => 'cafe',
            'password' => bcrypt('kunci123'),
            'no_wa' => '0823211342345',
        ]);
        \App\Models\User::create([
            'username' => 'user',
            'name' => 'user',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => bcrypt('kunci123'),
            'no_wa' => '0823211342345',
        ]);
    }
}
