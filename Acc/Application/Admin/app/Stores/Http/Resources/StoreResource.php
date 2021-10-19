<?php

namespace Acc\Admin\Stores\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'group_id' => $this->group->id,
            'group' => $this->getGroup()
        ];
    }

    public function getGroup()
    {
        return [
            'id' => $this->group->id,
            'name' => $this->group->name,
        ];
    }
}
