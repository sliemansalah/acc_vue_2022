<?php

namespace Rfof\Domain\Seller\ContactUs\Models;

use Illuminate\Database\Eloquent\Model;

class ContcatUs extends Model
{
    protected $table = 'contactUs';

    protected $fillable = [
        'name',
        'email',
        'message',
        'attachments',
        'store_id'
    ];

}
