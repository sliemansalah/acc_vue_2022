<?php


namespace Acc\Domain\Admin\Activity\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Admin\Group\Models\Group;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'status',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function scopeFilter($query)
    {
        $sortField = \request('sort_field');

        if (!in_array($sortField, ['id','created_at','group_id', 'updated_at'])) {
            $sortField = 'id';
        }
        $sortDirection = \request('sort', 'asc');

        $filled = array_filter(\request()->only([
            'name'
        ]));
        $query->when(count($filled) > 0, function ($query) use ($filled) {
            foreach ($filled as $column => $value) {
                $query->where($column, 'LIKE', '%' . $value . '%');
            }
        })->when(\request('status') != '', function ($query) {
            $query->whereIn('status', explode(',', request('status')));
        })->when(request('group_id') != '', function ($query) {
            $query->whereIn('group_id', explode(',', request('group_id')));
        })->when(\request('search', '') != '', function ($query) {
            $search = '%' . request('search') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', $search);
            });
        })->orderBy($sortField, $sortDirection);
    }

}
