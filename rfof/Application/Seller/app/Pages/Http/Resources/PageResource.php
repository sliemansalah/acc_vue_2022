<?php


namespace Rfof\Seller\Pages\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => @$this->id,
            'title' => @$this->title,
            'description' => @$this->description,
            'page_type' => @$this->page_type,
        ];
    }

}
