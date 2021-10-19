<?php

namespace Rfof\Admin\ItemTypes\Http\Controllers;

use App\Http\Controllers\Controller;
use Rfof\Admin\ItemTypes\Http\Requests\ItemTypeRequest;
use Rfof\Admin\ItemTypes\Http\Resources\ItemTypeResource;
use Rfof\Domain\Admin\ItemType\Services\ItemTypeService;
use Rfof\Domain\Core\Response;
use Rfof\Domain\Seller\Items\Models\ItemType;

class ItemTypeController extends Controller
{

    public function index()
    {
        $itemType = ItemType::all();

        return Response::success($itemType)->mapInto(ItemTypeResource::class)->getList()->send();
    }

    public function getAll()
    {
        return Response::success($this->service()->newQuery()->filter()->paginate(10))
            ->mapInto(ItemTypeResource::class)->withPagination()->send();
    }

    public function store(ItemTypeRequest $request)
    {
        return Response::success(
            $this->service()->save($request->all())
        )->mapInto(ItemTypeResource::class)
            ->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(ItemTypeResource::class)->send();
    }

    public function update($id,ItemTypeRequest $request)
    {
        $this->service()->newResourceWith($this->service()->update($request->all(), $id));
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(ItemTypeResource::class)
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
        return new ItemTypeService();
    }
}

