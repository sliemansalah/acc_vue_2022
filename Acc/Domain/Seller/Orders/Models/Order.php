<?php

namespace Acc\Domain\Seller\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Seller\Coupons\Models\Coupon;
use Acc\Domain\Seller\Customers\Models\Customer;
use Acc\Domain\Seller\Items\Models\Item;
use Acc\Domain\Seller\Stores\Models\Store;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'discount',
        'coupon_code',
        'subtotal',
        'total',
        'payment_method_id',
        'shipping_id',
        'status',
        'store_id'
    ];


    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_items')
            ->withPivot('price', 'qty')
            ->withTimestamps();
    }

    public static function totalSales()
    {
        return self::query()->where('store_id', auth('store')->id())->sum('total');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_code');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function scopeFilter($query)
    {
        $sortField = \request('sort_field');

        if (!in_array($sortField, ['id', 'total','sub_total','discount', 'created_at', 'updated_at'])) {
            $sortField = 'created_at';
        }
        $sortDirection = \request('sort', 'desc');

        $query->when(\request('status') != '', function ($query) {
            $query->where('status', request('status'));
        })->when(request('customer') != '', function ($query) {
            $query->whereIn('customer_id', request('customer'));
        })->when(request('fromDate') != '', function ($query) {
                $query->whereDate('created_at', '>=', request('fromDate'));
        })->when(request('toDate') != '', function ($query) {
                $query->whereDate('created_at', '<=', request('toDate'));
        })->orderBy($sortField, $sortDirection);
    }
}
