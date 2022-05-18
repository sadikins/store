<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use Faker\Factory as Faker;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       
        $faker = Faker::create();

        for($i = 0; $i > 10; $i++) {
            
            $customer = new Customer;

            $customer->name   = $faker->name();
            $customer->no_telp = '081' . $faker->randomNumber(8);;
            $customer->address = $faker->address;
            $customer->save();
        }
    }
}
