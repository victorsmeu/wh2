<?php

namespace App\Http\Controllers;
use App\PatientData;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session, View;

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
        $this->middleware('accessPatients');

        $this->patientData = $patientData;
        
        View::share(['menu'=> 'patients']);
    }
    
    public function index($id)
    {
        return view('patient.ehr.index', [
            'patientData' => $this->patientData->getDataForPatient($id),
            'patient_id' => $id
        ]);
    }
    
    public function view($id)
    {
        return view('patient.ehr.view', [
            'patientData' => $this->patientData->getDataForPatient($id),
            'patient_id' => $id
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $input = [
            'patient_id' => $id,
            'label' => htmlentities(strip_tags($request->label)),
            'info' => htmlentities($request->info)
        ];
        $instance = PatientData::firstOrNew(array('patient_id' => $id, 'label' => $request->label));
        $instance->fill($input)->save();
        
        Session::flash('flash_message', 'Information updated ok!');
        return redirect()->route('patients.ehr', [$id]);
    }
    
    public function upload(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,png,pdf,xls,xlsx,doc,docx',
        ]);
        
        $filename = md5(microtime() . $id) . '.' . $request->file('file')->getClientOriginalExtension();
        $originalName = $request->file('file')->getClientOriginalName();
        
        try {
            $request->file('file')->move(storage_path('uploads'), $filename);
        } catch (Exception $ex) {
            Session::flash('flash_error_message', $ex);
        }
        
        $fileInfo = ['filename' => $filename, 'originalName' => $originalName];
        
        $input = [
            'patient_id' => $id,
            'label' => htmlentities(strip_tags($request->label)),
            'info' => json_encode($fileInfo)
        ];
        $this->patientData->create($input);
        
        
        return redirect()->route('patients.ehr', [$id]);
    }
}
