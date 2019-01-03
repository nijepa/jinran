<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['comment', 'user_id', 'meeting_detail_id'];

    protected $dates = ['created_at', 'updated_at'];

    public function meeting_detail()
    {
        return $this->belongsTo('App\Meeting_Detail');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
