<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $fillable = [
        'user_id', 
        'study_id_dicom', 
        'study_name', 
        'specialty_id', 
        'upload_status', 
        'patient_id',
        'institution', 
        'modality', 
        'bodyPart', 
        'creationDate', 
        'description', 
        'sex', 
        'age'
    ];

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
    
    public function study_users()
    {
        return $this->hasMany('App\StudiesUser');
    }
    
    public function reports()
    {
        return $this->hasMany('App\Report');
    }
}
