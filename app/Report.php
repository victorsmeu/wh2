<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['study_id', 'user_id', 'content', 'active', 'published_at', 'viewed', 'viewed_at'];
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    public function study()
    {
        return $this->belongsTo('App\Study');
    }
}
