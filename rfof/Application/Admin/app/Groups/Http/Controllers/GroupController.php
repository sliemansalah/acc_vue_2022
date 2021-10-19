<?php

namespace Rfof\Admin\Groups\Http\Controllers;

use App\Http\Controllers\Controller;
use Rfof\Admin\Countries\Http\Resources\CountryResource;
use Rfof\Admin\Groups\Http\Requests\GroupRequest;
use Rfof\Admin\Groups\Http\Resources\GroupsResource;
use Rfof\Domain\Admin\Group\Services\GroupService;
use Rfof\Domain\Core\Response;

class GroupController extends Controller
{
    public function index()
    {
        return Response::success($this->service()->newQuery()->filter()->paginate(10))
            ->mapInto(GroupsResource::class)->withPagination()->send();
    }

    public function listGroup()
    {
        return Response::success($this->service()->newQuery()->get())
            ->mapInto(GroupsResource::class)->withPagination()->send();
    }

    public function store(GroupRequest $request)
    {
        return Response::success(
            $this->service()->save($request->all())
        )->mapInto(GroupsResource::class)
            ->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())
            ->mapInto(GroupsResource::class)->send();
    }

    public function update($id,GroupRequest $request)
    {
        $this->service()->newResourceWith($this->service()->update($request->all(), $id));
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(GroupsResource::class)
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
        return new GroupService();
    }
}
