<?php


namespace Acc\Domain\Seller\Pages\Services;

use Acc\Domain\Core\Services\PersistService;
use Acc\Domain\Seller\Pages\Models\Page;
use Acc\Seller\Pages\Http\Resources\PageResource;

class PageService extends PersistService
{

    public static $model = Page::class;
    public static $resource = PageResource::class;
}
