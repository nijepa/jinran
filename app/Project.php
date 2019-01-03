<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['title', 'user_id', 'company_id', 'type_id','date_p'];

    protected $dates = ['created_at', 'updated_at'];

    public function project_detail()
    {
        return $this->belongsTo('App\Project_Detail');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function type(){
        return $this->belongsTo('App\Type');
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }
}
