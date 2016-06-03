<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatientData;
use App\MedicData;
use App\Http\Requests;

class DownloadController extends Controller
{
    protected $patientData;
    protected $medicData;
    
    public function __construct(PatientData $patientData, MedicData $medicData)
    {
        $this->middleware('auth');

        $this->patientData = $patientData;
        $this->medicData = $medicData;
    }
    
    public function secureDownload($id, $file_id)
    {
        $this->middleware('accessPatients');
        
        $file = $this->patientData->find($file_id);
        $info = json_decode($file->info);
        
        return response()->download(storage_path('uploads') . '/' . $info->filename);
    }
    
    public function medicInfoDownload($id, $file_id)
    {        
        $file = $this->medicData->find($file_id);
        $info = json_decode($file->info);
        
        return response()->download(storage_path('uploads') . '/' . $info->filename);
    }
    
    public function medicImageView($id, $file_id)
    {        
        $file = $this->medicData->find($file_id);
        $info = json_decode($file->info);
        
        return file_get_contents(storage_path('uploads') . '/' . $info->filename);
    }
}
