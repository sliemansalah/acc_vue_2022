<?php

namespace Acc\Admin\Stores\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Acc\Admin\Activities\Http\Requests\ActivityRequest;
use Acc\Admin\Activities\Http\Resources\ActivityResource;
use Acc\Domain\Admin\Activity\Services\ActivityService;
use Acc\Domain\Admin\Stores\Models\Store;
use Acc\Domain\Core\Response;
use Acc\Domain\Admin\Sellers\Models\Seller;

class StoreController extends Controller
{

    public function index()
    {
        return Response::success($this->service()->newQuery()->get())->mapInto(ActivityResource::class)->send();
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $sellerData  = \request('seller')->only(['name', '']);
            $seller =Seller::query()->create([
                'name'=>$request->nameSeller,
                'email'=>$request->emailSeller,
                'image'=>$request->imageSeller,
                'mobile'=>$request->mobileSeller,
                'status'=>$request->statusSeller,
            ]);
           $store =  Store::query()->create([
                'name'=>$request->nameStore,
                'email'=>$request->emailStore,
                'mobile'=>$request->mobileStore,
                'password'=>bcrypt($request->password),
                'image'=>$request->image,
                'description'=>$request->description,
                'seller_id'=>$seller['id'],
                'published'=>$request->published,
                'approved'=>$request->approved,
                'status'=>$request->status,
            ]);
            DB::commit();
            return Response::success(['Seller'=>$seller , 'Store'=>$store])->withMessage('Saved Successfully')->send() ;
        }catch (\Exception $ex){
            DB::rollback();
            return Response::error()->withMessage('Error')->send();

        }

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
