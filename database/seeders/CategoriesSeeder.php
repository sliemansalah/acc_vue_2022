<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rfof\Domain\Seller\Categories\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->create([
            'name' => 'سيارات',
            'image' => '',
            'store_id' => 1,
            'parent_id' => null,
            'status' => 1,

        ]);

        Category::query()->create([
            'name' => 'سيارات نقل',
            'image' => '',
            'store_id' => 1,
            'parent_id' => 1,
            'status' => 1,

        ]);
        Category::query()->create([
            'name' => "خضراوات",
            'image' => '',
            'store_id' => 1,
            'parent_id' => null,
            'status' => 1,

        ]);

        Category::query()->create([
            'name' => " سيارة مرسيدس",
            'image' => '',
            'store_id' => 1,
            'parent_id' => 2,
            'status' => 1,

        ]);

        Category::query()->create([
            'name' => "بطاطا",
            'image' => '',
            'store_id' => 1,
            'parent_id' => 3,
            'status' => 1,
        ]);
    }
}
