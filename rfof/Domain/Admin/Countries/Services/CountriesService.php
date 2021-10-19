<?php


namespace Rfof\Domain\Admin\Countries\Services;

use Rfof\Admin\Countries\Http\Resources\CountryResource;
use Rfof\Domain\Admin\Countries\Models\Country;
use Rfof\Domain\Core\Services\AdminPersistService;

class CountriesService extends AdminPersistService
{
    public static $model = Country::class;
    public static $resource = CountryResource::class;

}
