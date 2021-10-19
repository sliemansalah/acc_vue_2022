<?php

namespace Rfof\Domain\Seller\Customers\Models;

use Illuminate\Database\Eloquent\Model;
use Rfof\Domain\Core\Traits\ImageUpload;
use Rfof\Domain\Seller\Countries\Models\Country;
use Rfof\Domain\Seller\Messages\Models\Message;
use Rfof\Domain\Seller\Orders\Models\Order;
use Rfof\Domain\Seller\Questions\Models\Question;
use Rfof\Domain\Seller\Stores\Models\Store;

class Customer extends Model
{
    use ImageUpload;

    public $folderName = 'customer';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'image',
        'password',
        'status',
        'country_id',
        'store_id'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeFilter($query)
    {
        $sortField = \request('sort_field', 'created_at');

        if (!in_array($sortField, ['id', 'first_name', 'last_name', 'status', 'email', 'mobile', 'created_at'])) {
            $sortField = 'created_at';
        }

        $sortDirection = \request('sort_direction', 'desc');

        if (!in_array($sortDirection, ['desc', 'asc'])) {
            $sortDirection = 'desc';
        }

        $filled = array_filter(\request()->only([
            'first_name',
            'last_name',
            'email',
            'mobile'
        ]));

        $query->when(count($filled) > 0, function ($query) use ($filled) {
            foreach ($filled as $column => $value) {
                $query->where($column, 'LIKE', '%' . $value . '%');
            }
        })->when(\request('search', '') != '', function ($query) {
            $search = '%' . request('search') . '%';
            $query->where('first_name', 'like', $search)
                ->orWhere('last_name', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orWhere('mobile', 'like', $search);
        })->when(\request('status', '') != '', function ($query) {
            $query->where('status', request('status'));
        })->when(\request('fromDate', '') != '', function ($query) {
            $query->whereDate('created_at', '>=', request('fromDate'));
        })->when(\request('toDate', '') != '', function ($query) {
            $query->whereDate('created_at', '<=', request('toDate'));
        })->orderBy($sortField, $sortDirection);
    }
}
