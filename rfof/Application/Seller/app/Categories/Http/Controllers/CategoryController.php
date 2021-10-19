<?php


namespace Rfof\Seller\Categories\Http\Controllers;


use App\Http\Controllers\Controller;
use Rfof\Domain\Core\Response;
use Rfof\Domain\Seller\Categories\Services\CategoryService;
use Rfof\Seller\Categories\Http\Requests\CategoryRequest;
use Rfof\Seller\Categories\Http\Resources\CategoryResource;
use Rfof\Seller\Customers\Http\Resources\CustomerResource;


class CategoryController extends Controller
{

    public function index()
    {
        return Response::success($this->service()->newQuery()->main()->get())
            ->mapInto(CategoryResource::class)
            ->send();
    }

    public function store(CategoryRequest $request)
    {
        return Response::success(
            $this->service()->save($request->all())
        )->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(CategoryResource::class)->send();
    }

    public function update($id,CategoryRequest $request)
    {
        $this->service()->newResourceWith($this->service()->update($request->all(), $id));

        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(CategoryResource::class)->withMessage('updated successfully')->send();
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
        return new CategoryService();
    }
}
