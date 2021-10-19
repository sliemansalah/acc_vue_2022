<?php

namespace Rfof\Domain\Seller\Stores\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Rfof\Domain\Admin\Activity\Models\Activity;
use Rfof\Domain\Core\Traits\ImageUpload;
use Rfof\Domain\Seller\Categories\Models\Category;
use Rfof\Domain\Seller\Sellers\Models\Seller;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Store extends Authenticatable
{
    use HasFactory, ImageUpload, HasApiTokens;

    public $folderName = 'store';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'description',
        'password',
        'image',
        'published',
        'approved',
        'status'
    ];

    protected $casts = [
        'published' => 'boolean',
        'approved' => 'boolean',
        'status' => 'boolean'
    ];

    public function setting()
    {
        return $this->hasOne(Setting::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
