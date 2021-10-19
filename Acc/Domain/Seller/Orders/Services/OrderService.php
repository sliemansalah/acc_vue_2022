<?php


namespace Acc\Domain\Seller\Orders\Services;

use Illuminate\Support\Facades\Auth;
use Acc\Domain\Core\Services\PersistService;
use Acc\Domain\Seller\Coupons\Models\Coupon;
use Acc\Domain\Seller\Items\Models\Item;
use Acc\Domain\Seller\Orders\Models\Order;
use Acc\Domain\Seller\Orders\Models\OrderItem;
use Acc\Seller\Orders\Http\Resources\OrderResource;

class OrderService extends PersistService
{

    public static $model = Order::class;
    public static $resource = OrderResource::class;


    public function save($request)
    {
        $order = $this->newQuery()->create(array_merge($request, [
            'store_id' => Auth::guard('store')->id()
        ]));

       foreach (request('item') as $collect) {
            $item = Item::query()->where('id', $collect['item_id'])->first();
            $order->items()
                ->attach($collect['item_id'],
                    [
                        'price' => @$item['price'],
                        'qty' => isset($collect['qty']) ? $collect['qty'] : 0,
                        'line_total' => $collect['qty'] * $item['price']
                    ]);
        }

        $orderItem = Order::query()->findOrFail($order->id);
        $orderId = $orderItem->id;


        $line_total = OrderItem::query()->where('order_id', $orderId)
            ->select('line_total')
            ->sum('line_total');
        $orderItem->update([
            'total' => $line_total
        ]);

           $coupon =  Coupon::query()->where('code', request('coupon_code'))->first();


        if (isset($coupon)){
            if ($coupon->is_percent != 0) {
                $discount = $orderItem->total * $coupon->value / 100;
                $subTotal = $orderItem->total - $discount;
                $orderItem->update([
                    'subtotal' => $subTotal
                ]);
            } else {
                $discount = $orderItem->total - $coupon->value;
                $orderItem->update([
                    'subtotal' => $discount
                ]);
            }
        }else{
            $orderItem->update([
                'subtotal' => $line_total
            ]);
        }

            return $orderItem ;
    }

    public function update($request, $id)
    {
        $order = Order::query()->where('id', $id)->first();

        $order->update(array_merge($request, [
            'store_id' => auth('store')->id()
        ]));

        $order->items()->detach();

        foreach (request('item') as $collect) {
            $item = Item::query()->where('id', $collect['item_id'])->first();
            $order->items()
                ->attach($collect['item_id'],
                    [
                        'price' => @$item['price'],
                        'qty' => isset($collect['qty']) ? $collect['qty'] : 0,
                        'line_total' => $collect['qty'] * $item['price']
                    ]);
        }
        $orderItem = Order::query()->findOrFail($order->id);
        $orderId = $orderItem->id;

        $line_total = OrderItem::query()->where('order_id', $orderId)
            ->select('line_total')
            ->sum('line_total');

        $orderItem->update([
            'total' => $line_total
        ]);

        $coupon =  Coupon::query()->where('code', request('coupon_code'))->first();


        if (isset($coupon)){
            if ($coupon->is_percent != 0) {
                $discount = $orderItem->total * $coupon->value / 100;
                $subTotal = $orderItem->total - $discount;
                $orderItem->update([
                    'subtotal' => $subTotal
                ]);
            } else {
                $discount = $orderItem->total - $coupon->value;
                $orderItem->update([
                    'subtotal' => $discount
                ]);
            }
        }else{
            $orderItem->update([
                'subtotal' => $line_total
            ]);
        }

        return $orderItem ;

    }
}
