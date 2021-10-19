<?php


namespace Rfof\Admin\ContactUs\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AdminContactUsResource extends JsonResource
{

    public function toArray($request)
    {
        $attach = [];
        if (!is_null($this->attachments)){
            foreach (json_decode($this->attachments) as $attachment){
                $attach[] = 'http://127.0.0.1:8000/upload/'. @$attachment;
            }
        }
        return [
            'id' => @$this->id,
            'name' => @$this->name,
            'email' => @$this->email,
            'message' => @$this->message,
            'attachments' => @$this->attachments == null ? null :$attach,
            'store_id' => @$this->store_id,
            'store' => @$this->getStore($this->store->id)
        ];
    }


    public function getStore($store){
        return [
            'id'=>$this->store->id,
            'name'=>$this->store->name,
        ];
    }
}
