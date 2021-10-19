<?php


namespace Acc\Seller\Stores\Http\Controllers;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Acc\Admin\Activities\Http\Resources\GroupResource;
use Acc\Domain\Core\Response;
use Acc\Domain\Seller\Categories\Models\Category;
use Acc\Domain\Seller\Coupons\Models\Coupon;
use Acc\Domain\Seller\Customers\Models\Customer;
use Acc\Domain\Seller\Items\Models\Item;
use Acc\Domain\Seller\Orders\Models\Order;
use Acc\Domain\Seller\Rating\Models\Rating;
use Acc\Domain\Seller\Stores\Services\StoreService;
use Acc\Seller\Stores\Http\Requests\StoreRequest;
use Acc\Seller\Stores\Http\Resources\StoreResource;


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
