<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'category_id' => 10,
                'image'       => 'default.png',
                'barcode'     => 'IDR001',
                'title'       => 'Frisian Flag Purefarm',
                'description' => 'Diproduksi dengan susu segar pilihan, susu Frisian Flag dapat menghasilkan susu dengan cita rasa yang lezat dan bergizi.',
                'buy_price'   => 15000,
                'sell_price'  => 50000,
                'stock'       => 10,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'category_id' => 10,
                'image'       => 'default.png',
                'barcode'     => 'IDR002',
                'title'       => 'Indomilk',
                'description' => 'Sudah melalui proses sterilisasi HTST (High Temperature Short Time) yang dipanaskan pada suhu 140-145 derajat Celsius selama 4 detik sehingga akan membunuh bakteri jahat.',
                'buy_price'   => 15000,
                'sell_price'  => 50000,
                'stock'       => 10,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'category_id' => 4,
                'image'       => 'default.png',
                'barcode'     => 'IDR003',
                'title'       => 'Indomie Barbeque Chicken',
                'description' => 'Indomie Jumbo Mi Goreng Barbeque Chicken Flavour',
                'buy_price'   => 1500,
                'sell_price'  => 4900,
                'stock'       => 20,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'category_id' => 4,
                'image'       => 'default.png',
                'barcode'     => 'IDR004',
                'title'       => 'Nongshim Shin (Black)',
                'description' => 'Beef chunks, vegetable flakes and the sul-long-tang broth base make this traditional Korean hot & spicy soup nutrient rich and delicious.',
                'buy_price'   => 15000,
                'sell_price'  => 45000,
                'stock'       => 10,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'category_id' => 3,
                'image'       => 'default.png',
                'barcode'     => 'IDR005',
                'title'       => 'Roti Tawar - Sari Roti',
                'description' => 'diproduksi oleh PT.Nippon Indosari Corpindo',
                'buy_price'   => 14000,
                'sell_price'  => 16000,
                'stock'       => 10,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'category_id' => 3,
                'image'       => 'default.png',
                'barcode'     => 'IDR006',
                'title'       => 'Paroti',
                'description' => 'Berasal dari Jepang dimana produsennya bernama Yamazaki Baking.',
                'buy_price'   => 12000,
                'sell_price'  => 16000,
                'stock'       => 10,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'category_id' => 7,
                'image'       => 'default.png',
                'barcode'     => 'IDR007',
                'title'       => 'Silverqueen Chocolate Almond and Cashew',
                'description' => 'Cokelat Dengan Kacang Almond dan Mente 30gr',
                'buy_price'   => 8000,
                'sell_price'  => 12000,
                'stock'       => 10,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'category_id' => 7,
                'image'       => 'default.png',
                'barcode'     => 'IDR008',
                'title'       => 'Pocky Coklat',
                'description' => 'Glico Pocky Double Choco 45gr adalah biskuit stik yang diproduksi oleh Glico, salah satu perusahaan snack terbesar di Jepang yang telah berdiri sejak tahun 1966. ',
                'buy_price'   => 15000,
                'sell_price'  => 50000,
                'stock'       => 10,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'category_id' => 8,
                'image'       => 'default.png',
                'barcode'     => 'IDR009',
                'title'       => 'Royco Bumbu Kaldu Ayam 230 gr',
                'description' => 'Royco Kaldu Ayam merupakan bumbu pelezat masakan yang terbuat dari bahan-bahan dan rempah pilihan.',
                'buy_price'   => 6500,
                'sell_price'  => 9600,
                'stock'       => 10,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'category_id' => 8,
                'image'       => 'default.png',
                'barcode'     => 'IDR010',
                'title'       => 'Bango Kecap Manis 520 Ml',
                'description' => 'Soy Sauce, Kecap Manis Refill, Kecap Manis Pouch.',
                'buy_price'   => 18000,
                'sell_price'  => 23000,
                'stock'       => 10,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
        ];
    }
}
