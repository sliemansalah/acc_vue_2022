<?php
namespace Rfof\Domain\Seller\Categories\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rfof\Domain\Core\Traits\ImageUpload;
use Rfof\Domain\Seller\Items\Models\Item;
use Rfof\Domain\Seller\Sellers\Models\Seller;
use Rfof\Domain\Seller\Stores\Models\Store;

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
