<?php


namespace Rfof\Seller\ContactUs\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => @$this->id,
            'name' => @$this->name,
            'message' => @$this->message,
            'attachments' => json_decode(@$this->attachments),
        ];
    }

}
