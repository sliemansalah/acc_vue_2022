<?php

namespace Rfof\Domain\Seller\Cart\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id','item_id','quantity'];
}
