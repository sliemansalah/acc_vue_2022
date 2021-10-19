<?php

namespace Rfof\Domain\Seller\Rating\Models;

use Illuminate\Database\Eloquent\Model;
use Rfof\Domain\Seller\Customers\Models\Customer;
use Rfof\Domain\Seller\Items\Models\Item;
use Rfof\Domain\Seller\Stores\Models\Store;

class Rating extends Model
{
    protected $fillable = ['customer_id','store_id','item_id','comment','rating','approved'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function scopeFilter($query)
    {
        $sortField = \request('sort_field');

        if (!in_array($sortField, ['id','rating','created_at', 'updated_at'])) {
            $sortField = 'created_at';
        }
        $sortDirection = \request('sort', 'desc');

        $query->when(\request('approved') != '', function ($query) {
            $query->where('approved', request('approved'));
        })->when(\request('rating', '') != '', function ($query){
            switch (request('operator')){
                case 0:
                    $opr = '<';
                    break;
                case 1:
                    $opr = '=';
                    break;
                case 2:
                    $opr = '>';
                    break;
                default:
                    break;
            }
            $query->where('rating', $opr, request('rating'));
        })->when(request('customer') != '', function ($query) {
            $query->whereIn('customer_id', request('customer'));
        })->when(request('item') != '', function ($query) {
            $query->whereIn('item_id', request('item'));
        })->when(request('fromDate') != '', function ($query) {
            $query->whereDate('created_at', '>=', request('fromDate'));
        })->when(request('toDate') != '', function ($query) {
            $query->whereDate('created_at', '<=', request('toDate'));
        })->orderBy($sortField, $sortDirection);
    }


}
