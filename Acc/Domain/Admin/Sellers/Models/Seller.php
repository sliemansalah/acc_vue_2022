<?php

namespace Acc\Domain\Admin\Sellers\Models;

use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Core\Traits\ImageUpload;
use Acc\Domain\Seller\Stores\Models\Store;

class Seller extends Model
{
    use ImageUpload ;

    protected $fillable = ['name','email', 'image','mobile','status'];

    public function store()
    {
        return $this->hasOne(Store::class);
     }
}
