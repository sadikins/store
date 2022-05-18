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
                'image' => '',
                'name' => 'Drinks',
                'description' => 'Jenis minuman berenergi, obat, soda, jus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '',
                'name' => 'Canned food',
                'description' => 'Makanan yang diawetkan dalam kaleng',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '',
                'name' => 'Bakery',
                'description' => 'Makanan yang terbuat dari roti',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '',
                'name' => 'Noodles',
                'description' => 'Mie dan jenisnya',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '',
                'name' => 'Dry good',
                'description' => 'Makanan yang diawetkan dengan cara dikeringkan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '',
                'name' => 'Syrup',
                'description' => 'Minuman sari buah',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '',
                'name' => 'Candies dan chocolate',
                'description' => 'Permen dan coklat',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '',
                'name' => 'Seasoning',
                'description' => 'Bumbu Dapur',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '',
                'name' => 'Local basic',
                'description' => '9 Bahan Pokok',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '',
                'name' => 'Milk and milk product',
                'description' => 'Susu untuk bayi hingga dewasa',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];

        DB::table('categories')->insert($category);
    }
}
