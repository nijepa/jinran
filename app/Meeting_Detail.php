<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting_Detail extends Model
{
    //
    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function meeting(){
        return $this->belongsTo('App\Meeting');
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
