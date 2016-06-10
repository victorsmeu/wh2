<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Study;
use App\StudiesUser;
use App\User;
use App\Patient;
use App\Specialty;
use App\History;
use App\Viewer;
use View, Session;

class StudiesController extends Controller
{
    protected $studies, $users;
    
    public function __construct(Study $study, User $user)
    {
        $this->middleware('auth');

        $this->studies = $study;
        $this->users = $user;
        
        View::share(['menu'=> 'studies']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patients, Viewer $viewers)
    {
        $myStudies = $this->studies
                        ->where(function($query) {
                            if(\Auth::user()->role_id > 2)
                                $query->where('studies.user_id', \Auth::user()->id);
                        })
                        ->orderBy("created_at", "desc")
                        ->get();   
        
        if(\Auth::user()->role_id < 4) {
        $usersStudies = $this->studies
                        ->select('studies.*', 'studies_users.accepted', 'studies_users.invited_at', 'studies_users.viewed_at')
                        ->leftJoin('studies_users', 'studies_users.study_id', '=', 'studies.id')
                        ->where(function($query) {
                            if(\Auth::user()->role_id > 2)
                                $query->where('studies_users.user_id', \Auth::user()->id);
                        })
                        ->orderBy("created_at", "desc")
                        ->get(); 
        } else {
            $usersStudies = [];
        }
        
        $arrayPatients = ['' => '- select -'];
        $patientList = $patients->where('user_id', \Auth::user()->id)->get();
        foreach($patientList as $patient) {
            $arrayPatients[$patient->id] = $patient->first_name . ' ' . $patient->last_name;
        }
        
        $liveViewers = $viewers->where('access', 'all')
                               ->orWhere(function ($query) {
                                   if(\Auth::user()->role_id == 3) {
                                       $query->where('access', 'medics');
                                   }
                                })
                               ->orWhere(function ($query) {
                                   if(\Auth::user()->role_id == 4) {
                                       $query->where('access', 'patients');
                                   }
                                })
                               ->get();
        
        return view('studies.index', [
            'myStudies' => $myStudies,
            'usersStudies' => $usersStudies,
            'medics' => $this->users->medics(),
            'arrayPatients' => $arrayPatients,
            'viewers' => $liveViewers
        ]);
    }

    
    public function create(Patient $patients, Specialty $specialties)
    {
        return view('studies.create', [
            'patients' => $patients->where('user_id', \Auth::user()->id)
                                   ->get(),
            'specialties' => $specialties->all()
        ]);
    }
    
    
    public function update(Request $request, $study_id)
    {
        $this->validate($request, [
            'patient_id' => 'required|integer',
        ]);
        
        $this->studies->where('id', $study_id)
                      ->where('user_id', \Auth::user()->id)
                      ->update(['patient_id' => $request->patient_id]);  
        
        return redirect()->back();
    }
    
    
    public function invite(Request $request, StudiesUser $studiesUser, History $history)
    {
        $input = $request->all();
        $input['invited_at'] = date('Y-m-d H:i:s');
        
        $user = $studiesUser->firstOrNew(['study_id' => $input['study_id'], 'user_id' => $input['user_id']]);
        $user->fill($input)->save();
        
        $medic = $this->users->where('id', $input['user_id'])->first();
        
        $history::create([
            'user_id' => $input['user_id'],
            'action' => 'Invited medic',
            'data' => 'Invitation to view study sent to medic: ' . $medic->first_name . ' ' . $medic->last_name
        ]);
        
        Session::flash('flash_message', 'Invitation sent ok!');
        return redirect()->back();
    }
    
    
    public function view($study_id, $viewer_id)
    {
        if(\Auth::user()->role_id == 3) {
            \App\StudiesUser::where('study_id', $study_id)
                            ->where('user_id', \Auth::user()->id)
                            ->update(['viewed_at' => date("Y-m-d H:i:s")]);
        }
        Session::flash('flash_message', 'Study viewed ok!');
        return redirect()->back();
    }


    public function accept($study_id, History $history)
    {
        \App\StudiesUser::where('study_id', $study_id)
                ->where('user_id', \Auth::user()->id)
                ->update(['accepted' => 1]);
        
        $study = $this->studies->where('id', $study_id)->first();
        
        $history::create([
            'user_id' => $study['user_id'],
            'action' => 'Invitation to view study accepted',
            'data' => 'Invitation to view study accepted for: ' . $study->patient->first_name . ' ' . $study->patient->last_name
        ]);
        
        Session::flash('flash_message', 'Study accepted ok!');
        return redirect()->back();
    }
    
    public function decline($study_id)
    {
        \App\StudiesUser::where('study_id', $study_id)
                ->where('user_id', \Auth::user()->id)
                ->update(['accepted' => 0]);
        
        $study = $this->studies->where('id', $study_id)->first();
        
        $history::create([
            'user_id' => $study['user_id'],
            'action' => 'Invitation to view study declined',
            'data' => 'Invitation to view study declined for: ' . $study->patient->first_name . ' ' . $study->patient->last_name
        ]);
        
        Session::flash('flash_message', 'Study declined!');
        return redirect()->back();
    }
    
    public function syncInformation($study_id_dicom, History $history)
    {
        $study = $this->studies->where('study_id_dicom', $study_id_dicom)
                               ->where('user_id', \Auth::user()->id) 
                               ->first();
        if($study->count() == 0) {
            $newStudy = [
                'user_id' => \Auth::user()->id, 
                'study_id_dicom' => $study_id_dicom, 
                'study_name' => 'New Study', 
                'specialty_id' => 1, 
                'upload_status' => 'done', 
                'patient_id' => 8,
                'institution' => 'Clinic WH', 
                'modality' => 'Rec', 
                'bodyPart' => 'Head', 
                'creationDate' => '2016-05-12', 
                'description' => 'Lorem ipsum', 
                'sex' => 'M', 
                'age' => 62
            ];
            $id = $this->studies->create($newStudy);
            
            $study = $this->studies->get($id);
        }
        
        $history::create([
            'user_id' => \Auth::user()->id,
            'action' => 'Study uploaded',
            'data' => 'Study was uploaded for patient: ' . $study->patient->first_name . ' ' . $study->patient->last_name
        ]);
    }
}
