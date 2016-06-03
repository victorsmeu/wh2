<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicSpecialty extends Model
{
    public function specialty()
    {
        return $this->hasOne('App\Specialty', 'id', 'specialty_id');
    }
    
    public function user()
    {
        return $this->belogsTo('App\User');
    }
}
