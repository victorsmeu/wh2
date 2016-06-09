<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session, View;
use App\Http\Requests\PatientRequest; //validation
use App\Patient;
use App\History;

class PatientsController extends Controller
{
    protected $patient;

    /**
     * Create a new controller instance.
     *
     * @param  Patient  $patient
     */
    public function __construct(Patient $patient)
    {
        $this->middleware('auth');
        $this->middleware('accessPatients');

        $this->patient = $patient;
        
        View::share(['menu'=> 'patients']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = $this->patient
                         ->select(DB::raw('patients.id, patients.user_id, first_name, last_name, gender, YEAR(CURDATE())-year_of_birth AS age'))
                         ->leftJoin('studies', 'studies.patient_id', '=', 'patients.id')
                         ->leftJoin('studies_users', 'studies_users.study_id', '=', 'studies.id')
                         ->where(function($query) {
                            if(\Auth::user()->role_id > 2)
                               $query->where('patients.user_id', \Auth::user()->id)
                                     ->orWhere('studies_users.user_id', \Auth::user()->id);
                         })
                         ->get();

        return view('patients.index', [
            'patients' => $patients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request, History $history)
    {
        $input = $request->all();
        $input['user_id'] = \Auth::user()->id;
        $this->patient->create($input);
        
        $history::create([
            'user_id' => \Auth::user()->id,
            'action' => 'New patient added',
            'data' => 'A new patient was added: ' . $input['first_name'] . ' ' . $input['last_name'] 
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        if(\Auth::user()->role_id > 2 && $this->patient->where('id', $id)->where('user_id', \Auth::user()->id)->count() == 0) {
//            return redirect()->route('patients.index');
//        }
        
        
        return view('patients.edit', [
            'patient' => $this->patient->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $id)
    {
        $input = $request->all();
        
        $this->patient->find($id)->update($input);
        Session::flash('flash_message', 'Information updated ok!');
        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->role_id > 2 && $this->patient->where('id', $id)->where('user_id', \Auth::user()->id)->count() == 0) {
            return redirect()->route('patients.index');
        }
        
        $this->patient->find($id)->delete();
        return redirect()->route('patients.index');
    }
}
