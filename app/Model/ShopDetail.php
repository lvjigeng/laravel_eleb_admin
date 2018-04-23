<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopDetail extends Model
{
    //
    protected $fillable = [
        'shop_name', 'shop_img', 'shop_rating','service_rating','foods_rating','high_or_low','h_l_percent','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','shop_category_id'
    ];
}
