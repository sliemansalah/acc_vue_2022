<?php

namespace Rfof\Admin\Activities\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
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
