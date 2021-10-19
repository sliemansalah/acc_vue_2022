<?php


namespace Acc\Domain\Admin\Activity\Services;

use Acc\Admin\Activities\Http\Resources\ActivityResource;
use Acc\Domain\Admin\Activity\Models\Activity;
use Acc\Domain\Core\Services\AdminPersistService;

class ActivityService extends AdminPersistService
{
    public static $model = Activity::class;
    public static $resource = ActivityResource::class;

}
