<?php


namespace Acc\Seller\Rating\Http\Controllers;


use App\Http\Controllers\Controller;
use Acc\Domain\Core\Response;
use Acc\Domain\Seller\Customers\Models\Customer;
use Acc\Domain\Seller\Items\Models\Item;
use Acc\Domain\Seller\Rating\Services\RatingService;
use Acc\Seller\Items\Http\Resources\ItemResource;
use Acc\Seller\Rating\Http\Requests\RatingRequest;
use Acc\Seller\Rating\Http\Resources\RatingResource;

class RatingController extends Controller
{

    public function index()
    {
        return Response::success($this->service()->newQuery()->filter()->paginate(10))
            ->mapInto(RatingResource::class)
            ->withPagination()
            ->send();
    }

    public function listCustomer()
    {
        $customers = CustomerResource::collection(
            Customer::query()->where('store_id', auth('store')->id())->get()
        )->map->listCustomer();

        return Response::success($customers)->send();
    }

    public function listItem()
    {
        $items = ItemResource::collection(
            Item::query()->where('store_id', auth('store')->id())->get()
        )->map->listItem();

        return Response::success($items)->send();
    }

    public function store(RatingRequest $request)
    {
        return Response::success(
            $this->service()->save($request->all())
        )->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(RatingResource::class)->send();
    }

    public function update($id, RatingRequest $request)
    {
        $this->service()->newResourceWith($this->service()->update($request->all(), $id));

        return Response::success(
            $this->service()->findModelQuery($id)->firstOrFail())
            ->mapInto(RatingResource::class)
            ->withMessage('updated successfully')->send();
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
        return new RatingService();
    }
}
