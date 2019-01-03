<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $fillable = ['reply', 'user_id', 'comment_id'];

    protected $dates = ['created_at', 'updated_at'];

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
    public function meeting_detail()
    {
        return $this->belongsTo('App\Meeting_Detail');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
