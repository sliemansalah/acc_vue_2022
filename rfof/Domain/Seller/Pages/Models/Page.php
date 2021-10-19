<?php

namespace Rfof\Domain\Seller\Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Rfof\Domain\Seller\Sellers\Models\Seller;
use Rfof\Domain\Seller\Stores\Models\Store;

class Page extends Model
{
    protected $fillable = ['title','description','page_type','store_id'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
