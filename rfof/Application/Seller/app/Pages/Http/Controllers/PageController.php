<?php


namespace Rfof\Seller\Pages\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rfof\Domain\Core\Response;
use \Rfof\Domain\Seller\Pages\Services\PageService;
use Rfof\Seller\Pages\Http\Requests\PageRequest;
use Rfof\Seller\Pages\Http\Resources\PageResource;

class PageController extends Controller
{

    public function index()
    {
        return Response::success($this->service()->newQuery()->paginate(10))
            ->mapInto(PageResource::class)
            ->withPagination()
            ->send();
    }

    public function store(PageRequest $request)
    {
        return Response::success(
            $this->service()->save($request->all()))->withMessage('Saved Successfully')->send();
    }

    public function find($id)
    {
        return Response::success($this->service()
            ->findModelQuery($id)
            ->firstOrFail())
            ->mapInto(PageResource::class)->send();
    }

    public function update($id, PageRequest $request)
    {
        $this->service()->newResourceWith($this->service()->update($request->all(), $id));

        return Response::success($this->service()
            ->findModelQuery($id)
            ->firstOrFail())
            ->mapInto(PageResource::class)->withMessage('updated successfully')->send();
    }


    public function destroy()
    {
        $this->service()->delete(\request()->all());

        return Response::success()
            ->withMessage('deleted successfully')->send();
    }

    public function service()
    {
        return new PageService();
    }
}
