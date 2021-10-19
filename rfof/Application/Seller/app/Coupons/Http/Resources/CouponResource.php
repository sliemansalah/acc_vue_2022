<?php


namespace Rfof\Seller\Coupons\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'is_percent' => $this->is_percent,
            'value' => $this->value,
            'start_date' => @$this->start_date,
            'end_date' => @$this->end_date,
            'status' => $this->status,
            'usage_limit_per_coupon' => $this->usage_limit_per_coupon,
            'usage_limit_per_customer' => $this->usage_limit_per_customer,
            'items' => collect(@$this->itemsNew)->map(function ($item){
                return [
                    'item_id' => $item['id'],
                    'exclude' => $item->pivot->exclude,
                    'name' => $item->name,
                ];
            }),
           /* 'items' => [
                'include_items' => $this->items(@$this->items),
                'exclude_items' => $this->items(@$this->excludeItems)
            ],*/
            'created_at' => $this->created_at->format('d-m-Y H:i'),
            'created_at_view' => $this->created_at
        ];
    }


    private function items($items)
    {
        return collect($items)->map(function ($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'exclude' => $item->pivot->exclude,
            ];
        });
    }
}
