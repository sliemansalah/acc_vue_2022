<?php


namespace Rfof\Domain\Admin\ItemType\Services;

use Rfof\Admin\ItemTypes\Http\Resources\ItemTypeResource;
use Rfof\Domain\Admin\ItemType\Models\ItemType;
use Rfof\Domain\Core\Services\AdminPersistService;

class ItemTypeService extends AdminPersistService
{
    public static $model = ItemType::class;
    public static $resource = ItemTypeResource::class;

}
