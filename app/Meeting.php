<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function meeting_detail(){
        return $this->belongsTo('App\Meeting_Detail');
    }

    public function document(){
        return $this->belongsTo('App\Document');
    }

    public function comment(){
        return $this->belongsTo('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
