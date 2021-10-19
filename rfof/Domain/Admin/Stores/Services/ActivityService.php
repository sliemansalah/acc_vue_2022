<?php


namespace Rfof\Domain\Admin\Activity\Services;

use Rfof\Admin\Activities\Http\Resources\ActivityResource;
use Rfof\Domain\Admin\Activity\Models\Activity;
use Rfof\Domain\Core\Services\AdminPersistService;

class ActivityService extends AdminPersistService
{
    public static $model = Activity::class;
    public static $resource = ActivityResource::class;

}
