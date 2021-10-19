<?php


namespace Rfof\Seller\Customers\Http\Controllers;


use App\Http\Controllers\Controller;
use Rfof\Domain\Core\Response;
use Rfof\Domain\Seller\Customers\Services\CustomerService;
use Rfof\Seller\Customers\Http\Requests\CustomerRequest;
use Rfof\Seller\Customers\Http\Resources\CustomerResource;

class CustomerController extends Controller
{

    public function index()
    {
        return Response::success($this->service()
            ->newQuery()
            ->filter()
            ->paginate(10))
            ->mapInto(CustomerResource::class)
            ->withPagination()
            ->send();
    }

    public function store(CustomerRequest $request)
    {
        return Response::success(
            $this->service()->newResourceWith($this->service()->save($request->all())))
            ->withMessage('Saved Successfully')->send();
    }

    public function storeMany()
    {
        return Response::success(
            $this->service()->saveManyCustomer(\request()->all()))->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(CustomerResource::class)->send();
    }

    public function update($id)
    {
        $rules = (new CustomerRequest())->rulesUpdate();
        $message = (new CustomerRequest())->messages();
        request()->validate($rules, $message);

        $this->service()->newResourceWith($this->service()->update(request()->all(), $id));

        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(CustomerResource::class)->withMessage('updated successfully')->send();
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
        return new CustomerService();
    }
}
