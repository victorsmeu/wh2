<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'user_data';
    
    protected $fillable = ['user_id', 'label', 'info'];
    
    protected $userData = [];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getDataForUser($user_id)
    {
        $data = $this->where('user_id', $user_id)->get();
        if(count($data) == 0) return [];
        foreach($data as $key => $value) {
            $this->userData[$value['label']] = $value;
        }  
        return $this->userData;
    }
}
