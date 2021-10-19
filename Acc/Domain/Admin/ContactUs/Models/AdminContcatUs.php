<?php

namespace Acc\Domain\Admin\ContactUs\Models;

use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Admin\Stores\Models\Store;

class AdminContcatUs extends Model
{
    protected $table = 'contactUs';

    protected $fillable = [
        'name',
        'email',
        'message',
        'attachments',
        'store_id'
    ];

    public function scopeFilter($query)
    {
        $sortField = \request('sort_field');

        if (!in_array($sortField, ['id','created_at','store_id', 'updated_at'])) {
            $sortField = 'created_at';
        }
        $sortDirection = \request('sort', 'desc');

        $query->when(request('store') != '', function ($query) {
            $query->whereIn('store_id', explode(',', request('store')));
        })->when(\request('search', '') != '', function ($query) {
            $search = '%' . request('search') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', $search)
                ->orWhere('email' ,'LIKE' , $search)
                ->orWhere('message' ,'LIKE' , $search);
            });
        })->orderBy($sortField, $sortDirection);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
