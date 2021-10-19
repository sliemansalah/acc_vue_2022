<?php


namespace Acc\Seller\Stores\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'published' => $this->published,
            'mobile_support1' => $this->setting->mobile_support1,
            'mobile_support2' => $this->setting->mobile_support2,
            'telegram_support' => $this->setting->telegram_support,
            'email_support' => $this->setting->email_support,
            'instagram' => $this->setting->instagram,
            'twitter' => $this->setting->twitter,
            'facebook' => $this->setting->facebook,
            'snapchat' => $this->setting->snapchat,
            'link_iphone' => $this->setting->link_iphone,
            'link_android' => $this->setting->link_android,
            'link' => $this->setting->link,
            'activities' => $this->getActivities($this->activities)
        ];
    }

    private function getActivities($activities)
    {
        return collect($activities)->map(function ($activity){
            return $activity['id'];
        });
    }

    private function storeSetting($setting)
    {
        return [
            'mobile_support1' => $setting['mobile_support1'],
            'mobile_support2' => $setting['mobile_support2'],
            'telegram_support' => $setting['telegram_support'],
            'email_support' => $setting['email_support'],
            'instagram' => $setting['instagram'],
            'twitter' => $setting['twitter'],
            'facebook' => $setting['facebook'],
            'snapchat' => $setting['snapchat'],
            'link_iphone' => $setting['link_iphone'],
            'link_android' => $setting['link_android'],
            'link' => $setting['link']
        ];
    }
}
