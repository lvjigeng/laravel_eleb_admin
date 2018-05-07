<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ActivityPrize extends Model
{
    //
    protected $fillable=[
      'activity_id','name','description','shopAccount_id'
    ];
    public function activity()
    {
       return $this->belongsTo(Activity::class);
    }

}
