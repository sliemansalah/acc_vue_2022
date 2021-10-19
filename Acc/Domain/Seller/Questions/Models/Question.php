<?php

namespace  Acc\Domain\Seller\Questions\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['store_id','customer_id','questions','status'];
}
