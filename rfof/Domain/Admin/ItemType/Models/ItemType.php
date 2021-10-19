<?php

namespace Rfof\Domain\Admin\ItemType\Models;

use Illuminate\Database\Eloquent\Model;
use Rfof\Domain\Core\Traits\ImageUpload;

class ItemType extends Model
{
    use ImageUpload;

    public $folderName = 'itemType';

    protected $fillable = ['name','description','image','status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * @param $query
     */
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
                $q->where('name', 'LIKE', $search)
                    ->orWhere('description', 'LIKE' , $search);
            });
        })->orderBy($sortField, $sortDirection);
    }
}
