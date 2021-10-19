<?php

namespace Acc\Admin\Activities\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'activities' => $this->getActivity()
        ];
    }

    private function getActivity()
    {
        return collect($this->activities)->map(function ($activity){
            return [
                'id' => $activity['id'],
                'name' => $activity['name']
            ];
        });
    }
}
