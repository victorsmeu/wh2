<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientData extends Model
{
    protected $table = 'patient_data';
    
    protected $fillable = ['patient_id', 'label', 'info'];
    
    protected $patientData = [
        'first_diagnostic' => '',
        'reason_for_investigation' => '',
        'medical_history' => '',
        'physical_exploration' => '',
        'lab_analysis' => '',
        'imaging' => '',
        'current_treatment' => '',
        'first_diagnostic_file' => '',
        'reason_for_investigation_file' => '',
        'medical_history_file' => '',
        'physical_exploration_file' => '',
        'lab_analysis_file' => '',
        'imaging_file' => '',
        'current_treatment_file' => ''
    ];

    public function getDataForPatient($patient_id)
    {
        $data = $this->where('patient_id', $patient_id)->get();
        foreach($data as $key => $value) {
            //Only files can have multiple values for now
            if(strpos($value['label'], '_file') !== false) {
                $value['info'] = json_decode($value['info']);
                $this->patientData[$value['label']][] = $value;
            }
            else $this->patientData[$value['label']] = $value;
        }  
        return $this->patientData;
    }
}
