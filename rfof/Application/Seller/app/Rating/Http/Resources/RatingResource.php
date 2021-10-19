<?php


namespace Rfof\Seller\Rating\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => @$this->id,
            'customer_id' => @$this->customer->id,
            'customer' => !is_null($this->customer) ? $this->getCustomer() : null,
            'item_id' => @$this->item->id,
            'item' => !is_null($this->item) ? $this->getItem() : null,
            'comment' => @$this->comment,
            'rating' => @$this->rating,
            'approved' => @$this->approved,
            'created_at' => @$this->created_at,

        ];
    }


    private function getCustomer()
    {
        return [
            'id' => $this->customer->id,
            'name' => $this->customer->first_name . ' ' . $this->customer->last_name
        ];
    }


    private function getItem()
    {
        return [
            'id' => $this->item->id,
            'name' => $this->item->name
        ];
    }
}
