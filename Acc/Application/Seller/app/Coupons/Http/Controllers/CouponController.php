<?php


namespace Acc\Seller\Coupons\Http\Controllers;


use App\Http\Controllers\Controller;
use Acc\Domain\Core\Response;
use Acc\Domain\Seller\Coupons\Services\CouponService;
use Acc\Seller\Coupons\Http\Requests\CouponRequest;
use Acc\Seller\Coupons\Http\Resources\CouponResource;


class CouponController extends Controller
{

    public function index()
    {
        return Response::success($this->service()->newQuery()->filter()->paginate(10))
            ->mapInto(CouponResource::class)
            ->withPagination()
            ->send();
    }

    public function store(CouponRequest $request)
    {
        return Response::success(
            $this->service()->newResourceWith($this->service()->store($request->all())))
            ->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(CouponResource::class)->send();
    }

    public function update($id, CouponRequest $request)
    {
        $this->service()->update($request->all(), $id);
        $coupon = $this->service()->newResourceWith($this->service()->findModelQuery($id)->firstOrFail());
        return Response::success($coupon)->withMessage('updated successfully')->send();

    }

    public function updateStatus()
    {
        $this->service()->updateStatus(\request()->all());

        return Response::success()->withMessage('updated status successfully')->send();
    }

    public function destroy()
    {
        $this->service()->delete(\request()->all());

        return Response::success()->withMessage('deleted successfully')->send();
    }

    public function service()
    {
        return new CouponService();
    }
}
