<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Study;
use App\User;
use App\Patient;
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
    public function index(Patient $patients)
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
        
        return view('studies.index', [
            'myStudies' => $myStudies,
            'usersStudies' => $usersStudies,
            'medics' => $this->users->medics(),
            'arrayPatients' => $arrayPatients
        ]);
    }

    
    public function create(\App\Patient $patients)
    {
        return view('studies.create', [
            'patients' => $patients->where('patients.user_id', \Auth::user()->id)
                                   ->get()
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
    
    
    public function invite(Request $request, \App\StudiesUser $studiesUser)
    {
        $input = $request->all();
        $input['invited_at'] = date('Y-m-d H:i:s');
        
        $user = $studiesUser->firstOrNew(['study_id' => $input['study_id'], 'user_id' => $input['user_id']]);
        $user->fill($input)->save();
        
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


    public function accept($study_id)
    {
        \App\StudiesUser::where('study_id', $study_id)
                ->where('user_id', \Auth::user()->id)
                ->update(['accepted' => 1]);
        Session::flash('flash_message', 'Study accepted ok!');
        return redirect()->back();
    }
    
    public function decline($study_id)
    {
        \App\StudiesUser::where('study_id', $study_id)
                ->where('user_id', \Auth::user()->id)
                ->update(['accepted' => 0]);
        Session::flash('flash_message', 'Study declined!');
        return redirect()->back();
    }
}
