<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Acc\Domain\Seller\Pages\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::query()->create([
            'title'=>'صفحة الخصائص',
            'store_id'=> 1,
            'page_type'=> 2,
        ]);

    Page::query()->create([
            'title'=>'صفحة عامة',
            'store_id'=> 1,
            'page_type'=> 1,
        ]);

     Page::query()->create([
            'title'=>'صفحة الاستبدال والاسترجاع',
            'store_id'=> 1,
            'page_type'=> 3,
        ]);
    }
}
