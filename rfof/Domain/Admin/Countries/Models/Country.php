<?php

namespace Rfof\Domain\Admin\Countries\Models;

use Illuminate\Database\Eloquent\Model;
use Rfof\Domain\Core\Traits\ImageUpload;

class Country extends Model
{
    use ImageUpload;

    public $folderName = 'Country';

    protected $fillable = ['name','zip_code','image','status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeFilter($query)
    {
        $sortField = \request('sort_field');

        if (!in_array($sortField, ['id','created_at','status', 'updated_at'])) {
            $sortField = 'created_at';
        }
        $sortDirection = \request('sort', 'desc');

        $filled = array_filter(\request()->only([
            'name',
            'zip_code',
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
                    ->orWhere('zip_code' ,'LIKE' , $search);
            });
        })->orderBy($sortField, $sortDirection);
    }

}
