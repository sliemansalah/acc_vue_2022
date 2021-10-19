<?php


namespace Acc\Domain\Seller\Coupons\Services;


use Illuminate\Support\Facades\DB;
use Acc\Domain\Core\Services\PersistService;
use Acc\Domain\Seller\Coupons\Models\Coupon;
use Acc\Seller\Coupons\Http\Resources\CouponResource;

class CouponService extends PersistService
{

    public static $model = Coupon::class;
    public static $resource = CouponResource::class;

    public function store($data)
    {
//        $model = $this->newModel();
//        $model->fill(request()->only($model->getFillable()));
//        $model->save();

        $model = $this->save($data);

        collect($data['items'])->each(function ($item) use ($model) {
            $model->itemsNew()->attach($item['item_id'], ['exclude' => $item['exclude']]);
        });

        return $model;
    }

    public function update($data, $id)
    {
        $this->findModelQuery($id)->find($id)
            ->update(array_merge($data, ['store_id' => auth('store')->id()]));

        $model = $this->newQuery()->findOrFail($id);

        if (isset($data['items'])) {
            $model->itemsNew()->detach();

            collect($data['items'])->each(function ($item) use ($model) {
                $model->itemsNew()->attach($item['item_id'], ['exclude' => $item['exclude']]);
            });

        }
        return $model;
    }

    public function delete($data)
    {
        $this->newQuery()->whereIn('id', explode(',', $data['ids']))->delete();

        return DB::table('coupon_item')->whereIn('coupon_id', explode(',', $data['ids']))->delete();
    }
}
