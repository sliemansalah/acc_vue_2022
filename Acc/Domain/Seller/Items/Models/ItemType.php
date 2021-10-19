<?php

namespace Acc\Domain\Seller\Items\Models;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    protected $fillable = ['name','description','image','status'];


}
