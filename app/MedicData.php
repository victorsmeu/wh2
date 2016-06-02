<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicData extends Model
{
    protected $table = 'patient_data';
    
    protected $fillable = ['patient_id', 'label', 'info'];
    
    protected $patientData = [
        'cv' => '',
        'cv_file' => '',
        'image' => '',
        'signature' => ''
    ];

    public function getDataForMedic($user_id)
    {
        $data = $this->where('user_id', $user_id)->get();
        if(count($data) == 0) return false;
        foreach($data as $key => $value) {
            $this->medicData[$value['label']] = $value;
        }  
        return $this->medicData;
    }
}
