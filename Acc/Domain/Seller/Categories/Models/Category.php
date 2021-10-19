<?php
namespace Acc\Domain\Seller\Categories\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Acc\Domain\Core\Traits\ImageUpload;
use Acc\Domain\Seller\Items\Models\Item;
use Acc\Domain\Seller\Sellers\Models\Seller;
use Acc\Domain\Seller\Stores\Models\Store;

class Category extends Model
{
    use HasFactory, ImageUpload;

    public $folderName = 'category';

    protected $fillable = ['name','image','store_id','parent_id','status'];

    protected $hidden = ['deleted_at', 'updated_at'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }
}
