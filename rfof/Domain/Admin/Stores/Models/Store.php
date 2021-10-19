<?php


namespace Rfof\Domain\Admin\Stores\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rfof\Domain\Core\Traits\ImageUpload;
use Rfof\Domain\Seller\Sellers\Models\Seller;

class Store extends Model
{
    use HasFactory , ImageUpload;

    public $folderName = 'store';

    protected $fillable = [
        'email',
        'name',
        'mobile',
        'password',
        'image',
        'description',
        'seller_id',
        'published',
        'approved',
        'status',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
