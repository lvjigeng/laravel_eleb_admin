<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopAccount extends Model
{
    //
    protected $fillable=[
        'name','password','status','shop_detail_id'
    ];

    public function shopDetail()
    {
        return $this->belongsTo(ShopDetail::class);
    }
}
