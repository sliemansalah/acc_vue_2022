<?php


namespace Rfof\Domain\Seller\Customers\Services;


use Rfof\Domain\Core\Services\PersistService;
use Rfof\Domain\Seller\Customers\Models\Customer;
use Rfof\Seller\Customers\Http\Resources\CustomerResource;

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
