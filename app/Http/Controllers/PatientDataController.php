<?php

namespace App\Http\Controllers;
use App\PatientData;
use View;

/**
 * Description of PatientDataController
 *
 * @author vsmeu
 */
class PatientDataController extends Controller
{
    protected $patientData;

    /**
     * Create a new controller instance.
     *
     * @param  Patient  $patient
     */
    public function __construct(PatientData $patientData)
    {
        $this->middleware('auth');
        //$this->middleware('accessPatients');

        $this->patientData = $patientData;
        
        View::share(['menu'=> 'patients']);
    }
    
    public function index()
    {
        return view('patient.ehr.index');
    }
}
