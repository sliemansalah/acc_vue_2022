<?php


namespace Rfof\Domain\Seller\Rating\Services;


use Rfof\Domain\Core\Services\PersistService;
use Rfof\Domain\Seller\Rating\Models\Rating;
use Rfof\Seller\Rating\Http\Resources\RatingResource;

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
