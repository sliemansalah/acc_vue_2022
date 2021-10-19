<?php

namespace Rfof\Admin\Countries\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'zip_code' => $this->zip_code,
            'image' => $this->image,
            'status' => $this->status,
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
