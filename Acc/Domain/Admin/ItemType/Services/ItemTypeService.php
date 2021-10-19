<?php


namespace Acc\Domain\Admin\ItemType\Services;

use Acc\Admin\ItemTypes\Http\Resources\ItemTypeResource;
use Acc\Domain\Admin\ItemType\Models\ItemType;
use Acc\Domain\Core\Services\AdminPersistService;

class ItemTypeService extends AdminPersistService
{
    public static $model = ItemType::class;
    public static $resource = ItemTypeResource::class;

}
