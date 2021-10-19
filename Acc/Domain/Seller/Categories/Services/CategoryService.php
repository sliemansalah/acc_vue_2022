<?php


namespace Acc\Domain\Seller\Categories\Services;

use Acc\Domain\Core\Services\PersistService;
use Acc\Domain\Seller\Categories\Models\Category;
use Acc\Seller\Categories\Http\Resources\CategoryResource;

class CategoryService extends PersistService
{

    public static $model = Category::class;
    public static $resource = CategoryResource::class;
}
