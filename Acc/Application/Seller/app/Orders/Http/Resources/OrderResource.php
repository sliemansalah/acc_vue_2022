<?php


namespace Acc\Seller\Orders\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => @$this->id,
            'item' => $this->getItem(@$this->items),
            'customer_id' => @$this->customer->id,
            'customer' => @$this->getCustomer($this->customer->id),
            'total' => @$this->total,
            'sub_total' => @$this->subtotal,
            'payment_method_id' => @$this->payment_method_id,
            'coupon_code' => @$this->coupon_code,
            'status' => @$this->status,
            'created_at' => @$this->created_at,
        ];
    }


    public function resourceFind()
    {
        return [
            'id' => @$this->id,
            'item' => $this->getItem(@$this->items),
            'customer_id' => @$this->customer->id,
            'customer' => @$this->getCustomer($this->customer->id),
            'total' => @$this->total,
            'sub_total' => @$this->subtotal,
            'payment_method_id' => @$this->payment_method_id,
            'coupon_code' => @$this->coupon_code,
            'status' => @$this->status,
        ];
    }
    private  function  getCustomer($customer){
            return [
                'customer_id'=>$this->customer->id,
                'name'=>$this->customer->first_name . ' ' . $this->customer->last_name,
            ];
    }

    private function getItem($items)
    {
        return collect($items)->map(function ($item) {
            return [
                'item_id' => $item->id,
                'name' => $item->name,
                'qty'=> $item->pivot->qty
            ];
        });

        /*  $result = [];

          foreach ($items as $item)
          {
              $result[] = [
                  'id' => $item['id'],
                  'name' => $item['name'],
              ];
          }

          return  $result;*/
    }


}
