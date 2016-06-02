<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudiesUser extends Model
{
    protected $fillable = [
        'study_id', 'user_id', 'invited_at', 'accepted', 'viewed_at',
    ];
    
    public function study()
    {
        return $this->belongsTo('App\Study');
    }
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
