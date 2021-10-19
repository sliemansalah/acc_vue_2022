<?php


namespace Rfof\Seller\Stores\Http\Controllers;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rfof\Admin\Activities\Http\Resources\GroupResource;
use Rfof\Domain\Core\Response;
use Rfof\Domain\Seller\Categories\Models\Category;
use Rfof\Domain\Seller\Coupons\Models\Coupon;
use Rfof\Domain\Seller\Customers\Models\Customer;
use Rfof\Domain\Seller\Items\Models\Item;
use Rfof\Domain\Seller\Orders\Models\Order;
use Rfof\Domain\Seller\Rating\Models\Rating;
use Rfof\Domain\Seller\Stores\Services\StoreService;
use Rfof\Seller\Stores\Http\Requests\StoreRequest;
use Rfof\Seller\Stores\Http\Resources\StoreResource;


class StoreController extends Controller
{
    public function dataDashboard()
    {
        $totalCategories = Category::query()->where('store_id', auth('store')->id())->count();
        $totalItems = Item::query()->where('store_id', auth('store')->id())->count();
        $totalCustomers = Customer::query()->where('store_id', auth('store')->id())->count();
        $totalCoupons = Coupon::query()->where('store_id', auth('store')->id())->count();
        $totalRates = Rating::query()->where('store_id', auth('store')->id())->count();
        $totalOrders = Order::query()->where('store_id', auth('store')->id())->count();
        $totalSales = Order::totalSales();
        $orderDays = Order::query()->where('store_id', auth('store')->id())->where('created_at', Carbon::now())->count();

        return Response::success(compact('totalSales','totalOrders', 'totalRates'
        , 'totalCoupons', 'totalCustomers', 'totalItems', 'totalSales', 'totalCategories',
        'orderDays'))->send();
    }
    public function getActivities()
    {
        return Response::success($this->service()->getActivitiesForEveryGroup())
            ->mapInto(GroupResource::class)
            ->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(StoreResource::class)->send();
    }

    public function update($id, StoreRequest $request)
    {
        $this->service()->newResourceWith($this->service()->update($request->all(), $id));

        return Response::success(
            $this->service()->findModelQuery($id)
                ->firstOrFail())->mapInto(StoreResource::class)
            ->withMessage('updated successfully')->send();
    }

    public function service()
    {
        return new StoreService();
    }
}
