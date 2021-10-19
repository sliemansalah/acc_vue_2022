<?php


namespace Rfof\Seller\Rating\Http\Controllers;


use App\Http\Controllers\Controller;
use Rfof\Domain\Core\Response;
use Rfof\Domain\Seller\Customers\Models\Customer;
use Rfof\Domain\Seller\Items\Models\Item;
use Rfof\Domain\Seller\Rating\Services\RatingService;
use Rfof\Seller\Customers\Http\Resources\CustomerResource;
use Rfof\Seller\Items\Http\Resources\ItemResource;
use Rfof\Seller\Rating\Http\Requests\RatingRequest;
use Rfof\Seller\Rating\Http\Resources\RatingResource;

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
