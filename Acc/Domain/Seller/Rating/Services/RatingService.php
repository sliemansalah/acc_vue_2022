<?php


namespace Acc\Domain\Seller\Rating\Services;


use Acc\Domain\Core\Services\PersistService;
use Acc\Domain\Seller\Rating\Models\Rating;
use Acc\Seller\Rating\Http\Resources\RatingResource;

class RatingService extends PersistService
{
    public static $model = Rating::class;
    public static $resource = RatingResource::class;

    public function updateStatus($data)
    {
        return $this->newQuery()
            ->whereIn('id', explode(',', $data['ids']))
            ->update(['approved' => $data['approved']]);
    }
}
