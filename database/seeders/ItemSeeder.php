<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rfof\Domain\Seller\Items\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item1 = Item::query()->create([
            'name' => 'كيبورد اصلي الماني',
            'description' => 'افضل الكيبوردات الموجودة في الساحة العالمية',
            'price' => 70.80,
            'qty' => 20,
            'store_id' => 1,
            'item_type_id' => 1,
            'status' => 1,
        ]);

        $item1->categories()->sync([1,2,3]);

        $item2 = Item::query()->create([
            'name' => 'سامسسونج اس 4',
            'description' => 'افضل الكيبوردات الموجودة في الساحة العالمية',
            'price' => 1800,
            'qty' => 100,
            'store_id' => 1,
            'item_type_id' => 2,
            'status' => 2,
        ]);

        $item2->categories()->sync([1,3]);

        $item3 = Item::query()->create([
            'name' => 'بطارية تركية اصلي',
            'description' => 'افضل الكيبوردات الموجودة في الساحة العالمية',
            'price' => 500,
            'qty' => 10,
            'store_id' => 1,
            'item_type_id' => 3,
            'status' => 3,
        ]);

        $item3->categories()->sync([4,5]);

        $item4 = Item::query()->create([
            'name' => 'ايفون اكس بلس',
            'description' => 'افضل الكيبوردات الموجودة في الساحة العالمية',
            'price' => 1800,
            'qty' => 100,
            'store_id' => 1,
            'item_type_id' => 4,
            'special_price' => 1700,
            'special_price_start' => '2021-03-12',
            'special_price_end' => '2021-04-01',
            'selling_price' => 1500,
            'status' => 3,
        ]);

        $item4->categories()->sync([4,5]);

        $item5 = Item::query()->create([
            'name' => 'ساعة ابل ذكية',
            'description' => 'افضل الكيبوردات الموجودة في الساحة العالمية',
            'price' => 3000,
            'qty' => 17,
            'store_id' => 1,
            'item_type_id' => 5,
            'status' => 4,
        ]);

        $item5->categories()->sync([1,2,3,4,5]);
    }
}
