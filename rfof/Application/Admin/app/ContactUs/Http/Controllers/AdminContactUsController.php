<?php


namespace Rfof\Admin\ContactUs\Http\Controllers;


use App\Http\Controllers\Controller;

use Rfof\Domain\Admin\ContactUs\Services\AdminContactUsService;
use Rfof\Domain\Core\Response;
use Rfof\Admin\ContactUs\Http\Resources\AdminContactUsResource;

class AdminContactUsController extends Controller
{

    public function index()
    {
        return Response::success($this->service()->newQuery()->filter()->paginate(10))
            ->mapInto(AdminContactUsResource::class)
            ->withPagination()
            ->send();
    }

    public function find($id)
    {
        return Response::success($this->service()
            ->findModelQuery($id)->findOrFail($id))
            ->mapInto(AdminContactUsResource::class)->send();
    }


    public function destroy()
    {
        $this->service()->delete(\request()->all());
        return Response::success()->withMessage('deleted successfully')->send();
    }

    public function service()
    {
        return new AdminContactUsService();
    }
}
