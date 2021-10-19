<?php


namespace Rfof\Domain\Seller\Coupons\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rfof\Domain\Seller\Items\Models\Item;
use Rfof\Domain\Seller\Stores\Models\Store;

class Coupon extends Model
{

    use HasFactory, SyncRelations;

    protected $fillable = [
        'name',
        'code',
        'is_percent',
        'value',
        'start_date',
        'end_date',
        'status',
        'store_id',
        'used',
        'usage_limit_per_coupon',
        'usage_limit_per_customer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date'
    ];


    public function scopeFilter($query)
    {
        $sortField = \request('sort_field', 'created_at');

        if (!in_array($sortField, ['id', 'name', 'code', 'status', 'start_date', 'end_date', 'created_at'])) {
            $sortField = 'created_at';
        }

        $sortDirection = \request('sort_direction', 'desc');

        if (!in_array($sortDirection, ['desc', 'asc'])) {
            $sortDirection = 'desc';
        }

        $filled = array_filter(\request()->only([
            'name',
            'code'
        ]));

        $query->when(count($filled) > 0, function ($query) use ($filled) {
            foreach ($filled as $column => $value) {
                $query->where($column, 'LIKE', '%' . $value . '%');
            }
        })->when(\request('value', '') != '', function ($query){
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
            $query->where('value', $opr, request('value'));
        })->when(\request('search', '') != '', function ($query) {
            $search = '%' . request('search') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', $search)
                    ->orWhere('code', 'LIKE', $search);
            });
        })->when(\request('status', '') != '', function ($query) {
            $query->whereIn('status', explode(',', request('status')));
        })->when(\request('fromDate', '') != '', function ($query) {
            $query->whereDate('created_at', '>=', request('fromDate'));
        })->when(\request('toDate', '') != '', function ($query) {
            $query->whereDate('created_at', '<=', request('toDate'));
        })->orderBy($sortField, $sortDirection);
    }

    public function valid()
    {
        if ($this->hasStartDate() && $this->hasEndDate()) {
            return $this->startDateIsValid() && $this->endDateIsValid();
        }

        if ($this->hasStartDate()) {
            return $this->startDateIsValid();
        }

        if ($this->hasEndDate()) {
            return $this->endDateIsValid();
        }

        return true;
    }

    public function invalid()
    {
        return !$this->valid();
    }

    private function hasStartDate()
    {
        return !is_null($this->start_date);
    }

    private function hasEndDate()
    {
        return !is_null($this->end_date);
    }

    private function startDateIsValid()
    {
        return today() >= $this->start_date;
    }

    private function endDateIsValid()
    {
        return today() <= $this->end_date;
    }

    public function usageLimitReached()
    {
        return $this->perCouponUsageLimitReached() || $this->perCustomerUsageLimitReached();
    }

    public function perCouponUsageLimitReached()
    {
        if (is_null($this->usage_limit_per_coupon)) {
            return false;
        }

        return $this->used >= $this->usage_limit_per_coupon;
    }

    public function perCustomerUsageLimitReached()
    {
        if (is_null($this->usage_limit_per_customer) || auth()->guest()) {
            return false;
        }

        $used = 5;

        return $used >= $this->usage_limit_per_customer;
    }

    public function itemsNew()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('exclude');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('exclude')
            ->wherePivot('exclude', 0);
    }

    public function excludeItems()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('exclude')
            ->wherePivot('exclude', 1);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
