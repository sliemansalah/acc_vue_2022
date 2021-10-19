<?php


namespace Acc\Domain\Core\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PersistService
{
    public $fillable;

    public static function make()
    {
        return new static();
    }

    public function model()
    {
        return static::$model;
    }

    public function newModel()
    {
        return new static::$model;
    }

    public function newQuery()
    {
        return static::$model::query()->where('store_id', auth('store')->id());
    }

    public function findModelQuery($value, $key = 'id')
    {
        if ($this->newQuery()->where($key, $value)->exists())
            return static::$model::where($key, $value);

        throw new \Exception('Model Not Found');
    }

    public function getFillable()
    {
        return $this->fillable ?? $this->newModel()->getFillable();
    }

    public function newResourceWith($model)
    {
        $resource = static::$resource;
        return $resource::make($model);
    }

    public function newResourceCollection($collection)
    {
        $resource = static::$resource;
        return $resource::collection($collection);
    }

    public function new(Request $request)
    {
        $model = $this->newModel();
        $model->fill($request->only($model->getFillable()));

        return $model;
    }

    public function save($data)
    {
        return $this->newModel()->create(array_merge($data,[
            'store_id' => auth('store')->id()
        ]));
    }

    public function update($data, $id)
    {
        return $this->findModelQuery($id)->firstOrFail()->update(array_merge($data,[
            'store_id' => auth('store')->id()
        ]));
    }

    public function updateStatus($data)
    {
            return $this->newQuery()
                ->whereIn('id', explode(',', $data['ids']))
                ->update(['status' => $data['status']]);
    }

    public function delete($data)
    {
        return $this->newQuery()->whereIn('id', explode(',', $data['ids']))->delete();
    }
}
