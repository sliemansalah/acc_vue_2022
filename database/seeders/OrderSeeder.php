<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rfof\Domain\Seller\Orders\Models\Order;
use Rfof\Domain\Seller\Orders\Models\OrderItem;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $order =  Order::query()->create([
            'customer_id'=> 1 ,
            'store_id'=>1,
            'subtotal'=>495.6,
            'total'=>495.6,
            'payment_method_id'=>1,
            'status'=>1,
        ]);
        OrderItem::query()->create([
           'order_id'=>$order->id,
           'item_id'=>1,
           'price'=>70.80,
           'qty'=>7,
            'line_total'=> 495.6
        ]);

    $order =  Order::query()->create([
            'customer_id'=> 2 ,
            'store_id'=>1,
            'subtotal'=>123,
            'total'=>123,
            'payment_method_id'=>1,
            'status'=>2,
        ]);
        OrderItem::query()->create([
           'order_id'=>$order->id,
           'item_id'=>2,
           'price'=>123,
           'qty'=>1,
            'line_total'=> 123
        ]);
    }
}
