<?php


namespace Rfof\Domain\Seller\Stores\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'store_id',
        'mobile_support1',
        'mobile_support2',
        'telegram_support',
        'email_support',
        'instagram',
        'twitter',
        'facebook',
        'snapchat',
        'link_iphone',
        'link_android',
        'link'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
