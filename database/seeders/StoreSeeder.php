<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Acc\Domain\Seller\Stores\Models\Setting;
use Acc\Domain\Seller\Stores\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createStore();
//        $this->updateStore();
    }

    public function createStore()
    {
        $store = Store::create([
            'id' => 1,
            'seller_id' => 1,
            'name' => 'متجر رفوف',
            'email' => 'store@rofo.com',
            'mobile' => '059263232',
            'password' => '123456',
            'image' => new UploadedFile(public_path('images/stores/1.png'), '1.png'),
            'published' => true,
            'approved' => true,
            'status' => true,
        ]);

        Setting::create([
            'store_id' => $store->id,
            'mobile_support1' => '0592643115',
            'mobile_support2' => '0592643116',
            'telegram_support' => 'te.com',
            'email_support' => 'rofo@gmail.com',
            'instagram' => 'instagram.com/rofof',
            'twitter' => 'twitter.com/rpfof',
            'facebook' => 'fb.com/fofof',
            'snapchat' => 'sc.com/rofof',
            'link_iphone' => '13464987dsada_iphone',
            'link_android' => '13464987dsada_android',
            'link' => '13464987dsada_link',
        ]);

        $store->activities()->sync([1,2,3]);
    }

    public function updateStore()
    {
        $store = Store::query()->find(1);

        $store->update([
            'name' => 'متجر رفوف الجديد',
            'published' => false,
            'approved' => false
        ]);

        $store->activities()->sync([4,5]);

        Setting::query()->where('store_id', 1)->update([
            'mobile_support1' => '0592643118',
            'mobile_support2' => '0592643119',
            'telegram_support' => 'tenew.com',
            'email_support' => 'rofonew@gmail.com',
            'instagram' => 'instagram.com/dsad/rofof',
            'twitter' => 'twitter.com/rpfof/dsa',
            'facebook' => 'fb.com/fofof/ada',
        ]);
    }
}
