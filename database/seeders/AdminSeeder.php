<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rfof\Domain\Admin\Auth\Model\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Admin::query()->create([
          'email'=>'admin@admin.com',
          'password'=>bcrypt(123456),
          'mobile'=>'059999999',
      ]);
    }
}
