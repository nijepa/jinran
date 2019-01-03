<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_Detail extends Model
{
    //
    public function subtype(){
        return $this->belongsTo('App\Subtype');
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
