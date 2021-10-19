<?php


namespace Rfof\Seller\Items\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'is_offer' => $this->is_offer,
            'special_price' => $this->special_price,
            'special_price_start' => $this->special_price_start,
            'special_price_end' => $this->special_price_end,
            'selling_price' => $this->selling_price,
            'qty' => $this->qty,
            'status' => $this->status,
            'image' => $this->image,
            'item_type_id' => $this->itemType->id,
            'item_type' => $this->getItemType(),
            'category' => $this->getCategory($this->categories),
            'created_at' => $this->created_at
        ];

    }

    public function listItem()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public function getCategory($categories)
    {
        return collect($categories)->map(function ($category) {

                return [
                    'id' => $category['id'],
                    'name' => $category['name']
                ];
            });
    }

    private function getItemType()
    {
        return [
            'value' => $this->itemType->id,
            'label' => $this->itemType->name,
        ];
    }

}
