<?php


namespace Acc\Domain\Seller\Stores\Services;


use Acc\Domain\Admin\Group\Models\Group;
use Acc\Domain\Core\Services\PersistService;
use Acc\Domain\Seller\Stores\Models\Setting;
use Acc\Domain\Seller\Stores\Models\Store;
use Acc\Seller\Stores\Http\Resources\StoreResource;

class StoreService extends PersistService
{
    public static $model = Store::class;
    public static $resource = StoreResource::class;

    public function getActivitiesForEveryGroup()
    {
        return Group::all();
    }

    public function newQuery()
    {
        return static::$model::query()->where('id', auth('store')->id());
    }

    public function update($data, $id)
    {
        $store = $this->newQuery()->find($id);

        if (request()->hasFile('image')){
            $uploadImage  = $this->uploadImage($data, $id);
            $store->update($uploadImage);
            return;
        }
        
        $storeData = $this->updateStore($data, $id);


        $store->update($storeData);

        $settingData = $this->updateSettingStore($data, $id);
        $this->settingQuery($id)->update($settingData);

        $store->activities()->sync(@$data['activities']);
    }

    private function updateStore($data, $id)
    {
        $store = $this->newQuery()->find($id);
        return [
            'name' => $data['name'] ?? $store['name'],
            'description' => @$data['description'] ?? @$store['description'],
        ];
    }


    private function updateSettingStore($data, $id)
    {
        $setting = $this->settingQuery($id)->first();

        return [
            'mobile_support1' => $data['mobile_support1'] ?? $setting['mobile_support1'],
            'mobile_support2' => $data['mobile_support2'] ?? $setting['mobile_support2'],
            'telegram_support' => $data['telegram_support'] ?? $setting['telegram_support'],
            'email_support' => $data['email_support'] ?? $setting['email_support'],
            'instagram' => $data['instagram'] ?? $setting['instagram'],
            'twitter' => $data['twitter'] ?? $setting['twitter'],
            'facebook' => $data['facebook'] ?? $setting['facebook'],
            'snapchat' => $data['snapchat'] ?? $setting['snapchat'],
            'link_iphone' => $data['link_iphone'] ?? $setting['link_iphone'],
            'link_android' => $data['link_android'] ?? $setting['link_android'],
            'link' => $data['link'] ?? $setting['link']
        ];
    }

    private function settingQuery($id)
    {
        return Setting::query()->where('store_id', $id);
    }

    private function uploadImage($data, $id)
    {
        $store = $this->newQuery()->find($id);
        return [
            'image' => $data['image'] ?? $store['image'],
        ];
    }
}
