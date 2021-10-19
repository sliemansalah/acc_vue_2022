<?php


namespace Rfof\Seller\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use Rfof\Domain\Core\Response;
use Rfof\Domain\Seller\Customers\Models\Customer;
use Rfof\Domain\Seller\Orders\Models\Order;
use Rfof\Domain\Seller\Orders\Services\OrderService;
use Rfof\Seller\Orders\Http\Requests\OrderRequest;
use Rfof\Seller\Orders\Http\Resources\OrderResource;
use Rfof\Seller\Pages\Http\Resources\PageResource;

class OrderController extends Controller
{
    public function index()
    {
        return Response::success($this->service()->newQuery()->filter()->paginate(10))
            ->mapInto(OrderResource::class)
            ->withPagination()
            ->send();
    }

    public function getOrderStatus()
    {
        $subStatus = Order::query()->select('status')->get();
        $status =  [
            'count_awaiting_payment' => \count($subStatus->where('status', 0)),
            'count_awaiting_review' => \count($subStatus->where('status', 1)),
            'count_underway' => \count($subStatus->where('status', 2)),
            'count_done' => \count($subStatus->where('status', 3)),
            'count_connecting' => \count($subStatus->where('status', 4)),
            'count_delivered' => \count($subStatus->where('status', 5)),
        ];
        return Response::success($status)->send();
    }
  public function getCustomer()
    {
        $customers = Customer::query()->get();
        foreach ($customers as $customer){
            $c[] = [
                    'id' => $customer->id,
                    'name' => $customer->first_name .' '.$customer->last_name
                ];
        }
        return Response::success($c)->send();
    }

    public function store(OrderRequest $request)
    {
        return Response::success(
            (new OrderResource(
                $this->service()->save($request->all())))
                ->resourceFind())->withMessage('Saved Successfully')->send();

    }

    public function find($id)
    {
        return Response::success(
            (new OrderResource(
                $this->
                service()->
                findModelQuery($id)->
                firstOrFail()))
                ->resourceFind()
        )->send();
    }

    public function update($id, OrderRequest $request)
    {
        $this->service()->newResourceWith($this->service()
            ->update($request->all(), $id));
        return Response::success(
            ( new OrderResource($this->service()
                ->findModelQuery($id)->firstOrFail()
            ))->resourceFind()
        )->withMessage('updated successfully')->send();

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
        return new OrderService();
    }


}
