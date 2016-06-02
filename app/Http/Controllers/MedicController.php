<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Auth, View;

class MedicController extends Controller
{
    protected $user;
    protected $medicData;

    public function __construct(User $user, MedicData $medicData)
    {
        $this->middleware('auth');

        $this->user = $user;
        $this->medicData = $medicData;

        View::share(['menu'=> 'medics']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medics.index', [
            'medics' => $this->user->where('role_id', 3)->get()
        ]);
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

    public function editCV()
    {
        $id = Auth::user()->id;
        
        return view('medics.edit-cv', [
            $medicData = $this->medicData->getDataForMedic($id)
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
        //
    }

}
