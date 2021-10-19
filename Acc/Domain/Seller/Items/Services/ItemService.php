<?php


namespace Acc\Domain\Seller\Items\Services;


use Acc\Domain\Core\Services\PersistService;
use Acc\Domain\Seller\Items\Models\Item;
use Acc\Seller\Items\Http\Resources\ItemResource;

class ItemService extends PersistService
{

    public static $model = Item::class;
    public static $resource = ItemResource::class;

    public function store($data)
    {
        /*$model = $this->newModel();
        $model->fill(request()->only($model->getFillable()));
        $model->save();*/

        $model = $this->save($data);

        $model->categories()->attach($data['category_id']);

        return $model;
    }

    public function update($data, $id)
    {
        $this->findModelQuery($id)->find($id)->update(array_merge($data, ['store_id' => auth('store')->id()]));
        $item = $this->newModel()->find($id);
        $item->categories()->sync($data['category_id']);
        return $item;
    }




}
