<?php

namespace Rfof\Admin\ItemTypes\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemTypeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
        ];
    }

    public function getList()
    {
        return [
            'value' => $this->id,
            'label' => $this->name,
        ];
    }
}
