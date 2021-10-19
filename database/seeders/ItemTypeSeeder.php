<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rfof\Domain\Seller\Items\Models\ItemType;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       ItemType::query()->create([
           'name'=>'منتج جاهز',
           'description'=>'المنتجات الملموسة والقابلة للشحن',
           'image'=>null,
           'status'=> 1,
       ]);
     ItemType::query()->create([
           'name'=>'خدمة حسب الطلب',
           'description'=>'تصميم, طباعة , الحجوزات',
           'image'=>null,
           'status'=>1,
       ]);
     ItemType::query()->create([
           'name'=>'اكل',
           'description'=>'المأكولات والمشروبات التي تتطلب شحن خاص',
         'image'=>null,
           'status'=> 0,
       ]);
     ItemType::query()->create([
           'name'=>'منتج رقمي',
           'description'=>'الكتب الالكترونية, الدورات',
           'image'=>null,
           'status'=>1,
       ]);
     ItemType::query()->create([
           'name'=>'بطاقة رقمية',
           'description'=>'بطاقات الشحن , حسابات الدفع',
         'image'=>null,
           'status'=>1,
       ]);
    ItemType::query()->create([
           'name'=>'مجموعة منتجات',
           'description'=>'اكثر من منتج في منتج واحد',
         'image'=>null,
           'status'=>1,
       ]);
    }
}
