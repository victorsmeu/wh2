<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicSpecialty extends Model
{
    public function specialties()
    {
        return $this->hasOne('App\Specialty', 'specialty_id', 'id');
    }
    
    public function user()
    {
        return $this->belogsTo('App\User');
    }
}
