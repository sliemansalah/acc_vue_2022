<?php

namespace Rfof\Domain\Seller\Sellers\Models;

use Illuminate\Database\Eloquent\Model;
use Rfof\Domain\Core\Traits\ImageUpload;
use Rfof\Domain\Seller\Stores\Models\Store;

class Seller extends Model
{
    use ImageUpload ;

    protected $fillable = ['name','email', 'image','mobile','status'];

    public function store()
    {
        return $this->hasOne(Store::class);
     }
}
