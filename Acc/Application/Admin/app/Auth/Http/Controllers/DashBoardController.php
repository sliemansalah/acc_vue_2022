<?php


namespace Acc\Admin\Auth\Http\Controllers;


use App\Http\Controllers\Controller;
use Acc\Domain\Admin\Activity\Models\Activity;
use Acc\Domain\Admin\Countries\Models\Country;
use Acc\Domain\Admin\Group\Models\Group;
use Acc\Domain\Admin\ItemType\Models\ItemType;
use Acc\Domain\Admin\Stores\Models\Store;
use Acc\Domain\Core\Response;

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
