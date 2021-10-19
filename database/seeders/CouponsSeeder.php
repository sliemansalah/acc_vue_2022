<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Acc\Domain\Seller\Coupons\Models\Coupon;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'name' => 'Percent Discount',
            'code' => Str::random(10),
            'is_percent' => 1,
            'value' => 10,
            'status' => 1,
            'store_id' => 1,
        ]);

        Coupon::create([
            'name' => 'Percent Discount1',
            'code' => Str::random(10),
            'is_percent' => 1,
            'value' => 20,
            'status' => 3,
            'store_id' => 1,
        ]);

        $coupon = Coupon::create([
            'name' => 'Anniversary',
            'code' => Str::random(10),
            'is_percent' => 0,
            'value' => 20,
            'start_date' => '2020-03-12',
            'end_date' => '2020-03-30',
            'usage_limit_per_coupon' => 50,
            'usage_limit_per_customer' => 5,
            'status' => 1,
            'store_id' => 1,
        ]);

//        $items = [1, 2];
//        $coupon = Coupon::query()->findOrFail(2);

        $items = [2, 3];


//        $coupon->items()->detach();

        collect($items)->map(function ($item) use($coupon) {
            $coupon->excludeItems()->attach([$item => ['exclude' => 0]]);
        });
    }
}
