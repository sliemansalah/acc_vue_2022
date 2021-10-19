<?php

namespace Rfof\Domain\Seller\Messages\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['customer_id','message'];
}
