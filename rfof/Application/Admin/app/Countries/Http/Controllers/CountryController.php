<?php

namespace Rfof\Admin\Countries\Http\Controllers;

use App\Http\Controllers\Controller;
use Rfof\Admin\Countries\Http\Requests\CountriesRequest;
use Rfof\Admin\Countries\Http\Resources\CountryResource;
use Rfof\Domain\Admin\Countries\Services\CountriesService;
use Rfof\Domain\Admin\ItemType\Services\ItemTypeService;
use Rfof\Domain\Core\Response;

class CountryController extends Controller
{

    public function index()
    {
        return Response::success($this->service()->newQuery()->get())->mapInto(CountryResource::class)->getList()->send();
    }

    public function getAll()
    {
        return Response::success($this->service()->newQuery()->filter()->paginate(10))
            ->mapInto(CountryResource::class)->withPagination()->send();
    }


    public function store(CountriesRequest $request)
    {
        return Response::success(
            $this->service()->save($request->all())
        )->mapInto(CountryResource::class)
            ->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(CountryResource::class)->send();
    }

    public function update($id, CountriesRequest $request)
    {
        $this->service()->newResourceWith($this->service()->update($request->all(), $id));
        return Response::success($this->service()->findModelQuery($id)->firstOrFail())->mapInto(CountryResource::class)
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
        return new CountriesService();
    }
}
