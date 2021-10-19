<?php

namespace Acc\Admin\Activities\Http\Controllers;

use App\Http\Controllers\Controller;
use Acc\Admin\Activities\Http\Requests\ActivityRequest;
use Acc\Admin\Activities\Http\Resources\ActivityResource;
use Acc\Domain\Admin\Activity\Services\ActivityService;
use Acc\Domain\Core\Response;

class ActivityController extends Controller
{

    public function index()
    {
        return Response::success($this->service()->newQuery()->filter()->paginate(10))
            ->mapInto(ActivityResource::class)->withPagination()->send();
    }


    public function store(ActivityRequest $request)
    {
        return Response::success(
            $this->service()->save($request->all())
        )->mapInto(ActivityResource::class)
            ->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(ActivityResource::class)->send();
    }

    public function update($id,ActivityRequest $request)
    {
        $this->service()->newResourceWith($this->service()->update($request->all(), $id));

        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(ActivityResource::class)
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
        return new ActivityService();
    }
}
