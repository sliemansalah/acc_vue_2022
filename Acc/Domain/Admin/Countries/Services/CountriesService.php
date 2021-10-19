<?php


namespace Acc\Domain\Admin\Countries\Services;

use Acc\Admin\Countries\Http\Resources\CountryResource;
use Acc\Domain\Admin\Countries\Models\Country;
use Acc\Domain\Core\Services\AdminPersistService;

class CountriesService extends AdminPersistService
{
    public static $model = Country::class;
    public static $resource = CountryResource::class;

}
