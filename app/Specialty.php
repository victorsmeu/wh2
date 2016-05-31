<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    public function studies()
    {
        return $this->hasMany('App\Study', 'specialty_id', 'id');
    }
    
    public function medicSpecialties()
    {
        return $this->belogsTo('App\MedicSpecialty');
    }
}
