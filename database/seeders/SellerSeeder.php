<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Rfof\Domain\Seller\Sellers\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::query()->create([
            'name' => 'Saji Hassanein',
            'email' => 'saji@saji.'.Str::random(5),
            'mobile' => '0592123'.random_int(0,10),
            'status' => 1,
        ]);

        Seller::query()->create([
            'name' => 'Suliman Salah',
            'email' => 'suliman@suliman.'.Str::random(5),
            'mobile' => '059211'.random_int(0,10),
            'status' => 1,
        ]);
        Seller::query()->create([
            'name' => 'Mosab Salah',
            'email' => 'Mosab@mosab.'.Str::random(5),
            'mobile' => '059264'.random_int(0,10),
            'status' => 1,
        ]);
    }
}
