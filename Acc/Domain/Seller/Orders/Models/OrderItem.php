<?php

namespace Acc\Domain\Seller\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Seller\Items\Models\Item;

class OrderItem extends Model
{
    protected $fillable = ['order_id','item_id','price','qty','line_total'];

    public function items()
    {
         return $this->hasMany(Item::class);
    }

    public function order()
    {
         return $this->belongsTo(Order::class);
    }

}
