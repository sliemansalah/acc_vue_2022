<?php

namespace Rfof\Domain\Admin\Group\Services;

use Rfof\Admin\Groups\Http\Resources\GroupsResource;
use Rfof\Domain\Admin\Group\Models\Group;
use Rfof\Domain\Core\Services\AdminPersistService;

class GroupService extends AdminPersistService
{
    public static $model = Group::class;
    public static $resource = GroupsResource::class;
}
