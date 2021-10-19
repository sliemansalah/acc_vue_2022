<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rfof\Domain\Seller\Categories\Models\Category;
use Rfof\Domain\Seller\Countries\Models\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::query()->create([
            'name' => 'السعودية',
            'zip_code' => '00966',
        ]);

        Country::query()->create([
            'name' => 'الامارات',
            'zip_code' => '00966',
        ]);

        Country::query()->create([
            'name' => 'فلسطين',
            'zip_code' => '00972',
        ]);

    }
}
