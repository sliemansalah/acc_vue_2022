<?php

namespace Acc\Domain\Seller\Items\Models;
;

use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Core\Traits\ImageUpload;
use Acc\Domain\Seller\Categories\Models\Category;
use Acc\Domain\Seller\Orders\Models\Order;
use Acc\Domain\Seller\Stores\Models\Store;

class Item extends Model
{
    use ImageUpload;

    public $folderName = 'item';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'special_price',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'qty',
        'is_offer',
        'sku',
        'status',
        'image',
        'store_id',
        'item_type_id',
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'special_price_start',
        'special_price_end',
        'deleted_at',
    ];


    public function scopeFilter($query)
    {
        $sortField = \request('sort_field', 'created_at');

        if (!in_array($sortField, ['id', 'name', 'price', 'is_offer', 'item_type_id', 'status', 'created_at'])) {
            $sortField = 'created_at';
        }

        $sortDirection = \request('sort_direction', 'desc');

        if (!in_array($sortDirection, ['desc', 'asc'])) {
            $sortDirection = 'desc';
        }

        $filled = array_filter(\request()->only([
            'name',
        ]));

        $query->when(count($filled) > 0, function ($query) use ($filled) {
            foreach ($filled as $column => $value) {
                $query->where($column, 'LIKE', '%' . $value . '%');
            }
        })->when(\request('item_type_id', '') != '', function ($query) {
            $query->where(function ($q) {
                $q->whereIn('item_type_id', request('item_type_id'));
            });
        })->when(\request('price', '') != '', function ($query){
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
            $query->where('price', $opr, request('price'));
        })->when(\request('category', '') != '', function ($query) {
            $query->whereHas('categories', function ($query){
                return $query->whereIn('category_id', request('category'));
            })->with('categories');
        })->when(\request('search', '') != '', function ($query) {
            $search = '%' . request('search') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', $search);
            });
        })->when(\request('status', '') != '', function ($query) {
            $query->whereIn('status', explode(',', request('status')));

        })->when(\request('fromDate', '') != '', function ($query) {
            $query->whereDate('created_at', '>=', request('fromDate'));
        })->when(\request('toDate', '') != '', function ($query) {
            $query->whereDate('created_at', '<=', request('toDate'));
        })->orderBy($sortField, $sortDirection);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function itemType()
    {
        return $this->belongsTo(ItemType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')->withPivot('price', 'qty');
    }
}
