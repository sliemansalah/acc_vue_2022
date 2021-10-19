<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Acc\Domain\Admin\Group\Models\Group;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group1 = Group::find(1);

        $group1->activities()->createMany([
            ['name' => 'الهواتف الذكية ومستلزماتها', 'status' => 1],
            ['name' => 'التلفزيونات', 'status' => 1],
            ['name' => 'السماعات', 'status' => 1],
        ]);

        $group2 = Group::find(2);

        $group2->activities()->createMany([
            ['name' => 'حدائق ونباتات', 'status' => 1],
            ['name' => 'اثاث', 'status' => 1],
            ['name' => 'مواد بناء', 'status' => 1],
        ]);

        $group3 = Group::find(3);

        $group3->activities()->createMany([
            ['name' => 'ازياء نسائية', 'status' => 1],
            ['name' => 'ازياء اطفال', 'status' => 1],
            ['name' => 'عبايات', 'status' => 1],
            ['name' => 'جوارب', 'status' => 1],
        ]);

        $group4 = Group::find(4);
        $group4->activities()->createMany([
            ['name' => 'مجوهرات', 'status' => 1],
        ]);
    }
}
