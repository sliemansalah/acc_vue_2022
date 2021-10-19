<?php


namespace Acc\Domain\Seller\Customers\Services;


use Acc\Domain\Core\Services\PersistService;
use Acc\Domain\Seller\Customers\Models\Customer;
use Acc\Seller\Customers\Http\Resources\CustomerResource;

class CustomerService extends PersistService
{

    public static $model = Customer::class;
    public static $resource = CustomerResource::class;

    public function saveManyCustomer($data)
    {

        return collect($data)->map(function ($customerData){
            return Customer::query()->create($customerData);
        });
    }
}
