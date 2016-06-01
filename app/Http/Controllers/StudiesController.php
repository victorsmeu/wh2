<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Study;
use App\User;
use View, Session;

class StudiesController extends Controller
{
    protected $study, $users;
    
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
    public function index()
    {
        $studies = $this->studies
                        ->select('studies.*', 'studies_users.accepted')
                        ->leftJoin('studies_users', 'studies_users.study_id', '=', 'studies.id')
                        ->where(function($query) {
                            if(\Auth::user()->role_id > 2)
                                $query->where('studies.user_id', \Auth::user()->id)
                                      ->orWhere('studies_users.user_id', \Auth::user()->id);
                        })
                        ->orderBy("created_at", "desc")
                        ->get();        
        return view('studies.index', [
            'studies' => $studies,
            'medics' => $this->users->medics()
        ]);
    }

    
    public function create()
    {
        return view('studies.create');
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
        
    }
}
