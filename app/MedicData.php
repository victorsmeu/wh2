<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicData extends Model
{
    protected $table = 'medic_data';
    
    protected $fillable = ['user_id', 'label', 'info'];
    
    protected $medicData = [
        /*'cv' => '',*/
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
