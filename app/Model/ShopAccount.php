<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopAccount extends Model
{
    //
    public function shopDetail()
    {
        return $this->belongsTo(ShopDetail::class);
    }
}
