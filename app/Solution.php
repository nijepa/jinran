<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    //
    protected $fillable = ['description', 'user_id', 'project_detail_id'];

    protected $dates = ['created_at', 'updated_at'];

    public function project_detail()
    {
        return $this->belongsTo('App\Project_Detail');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
