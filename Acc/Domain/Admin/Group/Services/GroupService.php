<?php

namespace Acc\Domain\Admin\Group\Services;

use Acc\Admin\Groups\Http\Resources\GroupsResource;
use Acc\Domain\Admin\Group\Models\Group;
use Acc\Domain\Core\Services\AdminPersistService;

class GroupService extends AdminPersistService
{
    public static $model = Group::class;
    public static $resource = GroupsResource::class;
}
