<?php

namespace Acc\Domain\Admin\Group\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Admin\Activity\Models\Activity;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];
    protected $casts = ['status'=> 'boolean'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function scopeFilter($query)
    {
        $sortField = \request('sort_field');

        if (!in_array($sortField, ['id','created_at','status', 'updated_at'])) {
            $sortField = 'created_at';
        }
        $sortDirection = \request('sort', 'desc');

        $filled = array_filter(\request()->only([
            'name'
        ]));
        $query->when(count($filled) > 0, function ($query) use ($filled) {
            foreach ($filled as $column => $value) {
                $query->where($column, 'LIKE', '%' . $value . '%');
            }
        })->when(request('status') != '', function ($query) {
            $query->whereIn('status', explode(',', request('status')));
        })->when(\request('search', '') != '', function ($query) {
            $search = '%' . request('search') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', $search);
            });
        })->orderBy($sortField, $sortDirection);
    }
}
