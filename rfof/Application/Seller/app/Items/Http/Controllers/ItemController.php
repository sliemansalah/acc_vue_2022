<?php


namespace Rfof\Seller\Items\Http\Controllers;


use App\Http\Controllers\Controller;
use Rfof\Domain\Core\Response;
use Rfof\Domain\Seller\Categories\Models\Category;
use Rfof\Domain\Seller\Items\Services\ItemService;
use Rfof\Seller\Categories\Http\Resources\CategoryResource;
use Rfof\Seller\Items\Http\Requests\ItemRequest;
use Rfof\Seller\Items\Http\Resources\ItemResource;


class ItemController extends Controller
{

    public function index()
    {
        return Response::success($this->service()->newQuery()->filter()->paginate(10))
            ->mapInto(ItemResource::class)
            ->withPagination()
            ->send();
    }

    public function listCategories()
    {
        $categories = CategoryResource::collection(
            Category::query()->where('store_id', auth('store')->id())->get()
        )->map->listCategory();

        return Response::success($categories)->send();
    }

    public function store(ItemRequest $request)
    {
        return Response::success(
            $this->service()
            ->store($request->all()))->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(ItemResource::class)->send();
    }

    public function update($id, ItemRequest $request)
    {
        $this->service()->newResourceWith($this->service()->update($request->all(), $id));

        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(ItemResource::class)->withMessage('updated successfully')->send();

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
        return new ItemService();
    }
}
