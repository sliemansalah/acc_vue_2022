<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Acc\Domain\Admin\Group\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::query()->create([
            'name' => 'الكترونيات',
            'status' => 1,
        ]);

        Group::query()->create([
            'name' => 'مستلزمات المنزل',
            'status' => 1,
        ]);

        Group::query()->create([
            'name' => 'ازياء',
            'status' => 1,
        ]);

        Group::query()->create([
            'name' => 'مجوهرات',
            'status' => 1,
        ]);
    }
}
