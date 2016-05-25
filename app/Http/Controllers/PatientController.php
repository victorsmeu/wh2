<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use App\Http\Requests;
use App\Patient;

class PatientController extends Controller
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

        $this->patient = $patient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('patient.index', [
            'patients' => $this->patient
                               ->select(DB::raw('id, first_name, last_name, gender, YEAR(CURDATE())-year_of_birth AS age'))
                               ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'year_of_birth' => 'required|integer|min:1900|max:2100',
            'gender' => 'required|in:M,F'
        ]);

        $this->patient->create($request->all());

        return redirect('/patients');
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
        return view('patient.edit', [
            'patient' => $this->patient->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->patient->find($id)->update($request->all());
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
        //
    }
}
