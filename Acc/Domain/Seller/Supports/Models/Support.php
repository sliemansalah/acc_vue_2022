<?php

namespace Acc\Domain\Seller\Supports\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = ['store_id','mobile','mobile2','whatsapp','email','link'];

}
