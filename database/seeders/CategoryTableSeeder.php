<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $category = [
            
            [
                'image' => 'default.png',
                'name' => 'Drinks',
                'description' => 'Jenis minuman berenergi, obat, soda, jus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'default.png',
                'name' => 'Canned food',
                'description' => 'Makanan yang diawetkan dalam kaleng',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'default.png',
                'name' => 'Bakery',
                'description' => 'Makanan yang terbuat dari roti',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'default.png',
                'name' => 'Noodles',
                'description' => 'Mie dan jenisnya',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'default.png',
                'name' => 'Dry good',
                'description' => 'Makanan yang diawetkan dengan cara dikeringkan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'default.png',
                'name' => 'Syrup',
                'description' => 'Minuman sari buah',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'default.png',
                'name' => 'Candies dan chocolate',
                'description' => 'Permen dan coklat',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'default.png',
                'name' => 'Seasoning',
                'description' => 'Bumbu Dapur',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'default.png',
                'name' => 'Local basic',
                'description' => '9 Bahan Pokok',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => 'default.png',
                'name' => 'Milk and milk product',
                'description' => 'Susu untuk bayi hingga dewasa',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];

        DB::table('categories')->insert($category);
    }
}
