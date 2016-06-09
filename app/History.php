<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    
    protected $fillable = array('user_id', 'action', 'data');
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
