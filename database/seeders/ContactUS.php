<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Acc\Domain\Seller\ContactUs\Models\ContcatUs;

class ContactUS extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContcatUs::query()->create([
            'name'=>'Ahmed',
            'email'=>'Ahmed@gmail.com',
            'message'=>'Hello ContactUs',
            'store_id'=> 1 ,
        ]);
    }
}
