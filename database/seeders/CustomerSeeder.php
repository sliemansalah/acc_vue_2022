<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Acc\Domain\Seller\Customers\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::query()->create([
            'first_name' => Str::random(5),
            'last_name' => Str::random(7),
            'email' => 'm@m.' .Str::random(10),
            'mobile' => '059264'.rand(0,20),
            'password' => bcrypt(123456),
            'country_id' => 1,
            'store_id' => 1
        ]);

        Customer::query()->create([
            'first_name' => Str::random(5),
            'last_name' => Str::random(7),
            'email' => 's@s.'.Str::random(10),
            'mobile' => '05926'.rand(0,20),
            'password' => bcrypt(123456),
            'country_id' => 2,
            'store_id' => 1
        ]);

        Customer::query()->create([
            'first_name' => Str::random(5),
            'last_name' => Str::random(7),
            'email' => 'sa@sa.'.Str::random(10),
            'mobile' => '0964'.rand(0,20),
            'password' => bcrypt(123456),
            'country_id' => 3,
            'store_id' => 1
        ]);

    }
}
