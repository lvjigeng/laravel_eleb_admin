<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable=[
        'title','start_time','end_time','detail','prize_date','signup_num','is_prize'
    ];

    public function activityPrize()
    {
        return $this->hasMany(ActivityPrize::class);
    }
}
