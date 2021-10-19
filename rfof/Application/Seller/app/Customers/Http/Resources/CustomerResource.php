<?php


namespace Rfof\Seller\Customers\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'image' => $this->image,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'status' => $this->status,
            'country_id' => $this->country_id,
            'country' => ! is_null($this->country) ? $this->getCountry() : null,
            'created_at' => $this->created_at->format('d/m/yy')
        ];
    }

    public function listCustomer()
    {
        return [
            'id' => $this->id,
            'full_name' => $this->first_name .' '. $this->last_name,
        ];
    }

    private function getCountry()
    {
        return [
            'id' => $this->country->id,
            'name' => $this->country->name
        ];
    }
}
