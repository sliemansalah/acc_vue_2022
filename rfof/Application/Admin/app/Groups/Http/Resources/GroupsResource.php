<?php

namespace Rfof\Admin\Groups\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
        ];
    }

}
