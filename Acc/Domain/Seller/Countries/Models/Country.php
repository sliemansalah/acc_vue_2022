<?php

namespace Acc\Domain\Seller\Countries\Models;

use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Seller\Profiles\Models\Profile;

class Country extends Model
{
    protected $fillable = ['name','zip_code','image','status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];
}
