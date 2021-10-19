<?php


namespace Rfof\Domain\Seller\Categories\Services;

use Rfof\Domain\Core\Services\PersistService;
use Rfof\Domain\Seller\Categories\Models\Category;
use Rfof\Seller\Categories\Http\Resources\CategoryResource;

class CategoryService extends PersistService
{

    public static $model = Category::class;
    public static $resource = CategoryResource::class;
}
