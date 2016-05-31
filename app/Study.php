<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    public function specialty()
    {
        return $this->hasOne('App\Specialty', 'id', 'specialty_id');
    }
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    public function patient()
    {
        return $this->hasOne('App\Patient', 'id', 'patient_id');
    }
    
    public function studies_users()
    {
        return $this->hasMany('App\StudiesUser');
    }
}
