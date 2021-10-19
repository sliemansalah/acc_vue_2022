<?php


namespace Rfof\Domain\Seller\Pages\Services;

use Rfof\Domain\Core\Services\PersistService;
use Rfof\Domain\Seller\Pages\Models\Page;
use Rfof\Seller\Pages\Http\Resources\PageResource;

class PageService extends PersistService
{

    public static $model = Page::class;
    public static $resource = PageResource::class;
}
