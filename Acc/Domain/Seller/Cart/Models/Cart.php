<?php

namespace Acc\Domain\Seller\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Seller\Customers\Models\Customer;

class Cart extends Model
{
    protected $fillable = ['customer_id','total_cost','store_id'];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function cartItem()
    {
        return $this->hasMany(CartItem::class);
    }
}
