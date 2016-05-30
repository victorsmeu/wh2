<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatientData;
use App\Http\Requests;

class DownloadController extends Controller
{
    protected $patientData;
    
    public function __construct(PatientData $patientData)
    {
        $this->middleware('auth');

        $this->patientData = $patientData;
    }
    
    public function secureDownload($id, $file_id)
    {
        $this->middleware('accessPatients');
        
        $file = $this->patientData->find($file_id);
        $info = json_decode($file->info);
        
        return response()->download(storage_path('uploads') . '/' . $info->filename);
    }
}
