<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Acc\Domain\Seller\Rating\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rating::query()->create([
            'customer_id'=> 1 ,
            'store_id'=> 1,
            'item_id'=> 1,
            'comment'=> 'No Comments',
            'rating'=> 1,
            'approved'=> 1,
        ]);
        Rating::query()->create([
            'customer_id'=> 2 ,
            'store_id'=> 1,
            'item_id'=> 2,
            'comment'=> 'No Comments',
            'rating'=> 2,
            'approved'=> 0,
        ]);
    }
}
