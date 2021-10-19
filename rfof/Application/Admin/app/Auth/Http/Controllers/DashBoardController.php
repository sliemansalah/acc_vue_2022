<?php


namespace Rfof\Admin\Auth\Http\Controllers;


use App\Http\Controllers\Controller;
use Rfof\Domain\Admin\Activity\Models\Activity;
use Rfof\Domain\Admin\Countries\Models\Country;
use Rfof\Domain\Admin\Group\Models\Group;
use Rfof\Domain\Admin\ItemType\Models\ItemType;
use Rfof\Domain\Admin\Stores\Models\Store;
use Rfof\Domain\Core\Response;

class DashBoardController extends Controller
{
    public function index()
    {
        $totalCountries = Country::query()->count();
        $totalActivities = Activity::query()->count();
        $totalGroups = Group::query()->count();
        $totalItemTypes = ItemType::query()->count();
        $totalStores = Store::query()->count();

        return Response::success(compact('totalActivities', 'totalCountries'
        ,'totalGroups', 'totalItemTypes', 'totalStores'))->send();
    }
}
