<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Report;
use Auth, View;


class ReportsController extends Controller
{
    protected $report;
    
    public function __construct(Report $report)
    {
        $this->report = $report;
        
        View::share(['menu'=> 'reports']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = $this->report
                        ->select('reports.*')
                         ->leftJoin('studies', 'studies.id', '=', 'reports.study_id')
                         ->where(function($query) {
                            if(\Auth::user()->role_id > 2)
                               $query->where('reports.user_id', \Auth::user()->id)
                                     ->orWhere('studies.user_id', \Auth::user()->id);
                         })
                         ->orderBy('published_at', 'desc')
                         ->get();

        return view('reports.index', [
            'reports' => $reports
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($study_id)
    {
        return view('reports.create', [
            'study_id' => $study_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $active = ($request->submit == 'publish') ? 1 : 0;
        $published_at = ($request->submit == 'publish') ? date('Y-m-d H:i:s') : 'null';
                
        $input = [
            'study_id' => $request->study_id, 
            'content' => $request->content, 
            'active' => $active, 
            'published_at' => $published_at
        ];
        
        $input['user_id'] = \Auth::user()->id;
        
        $this->report->create($input);

        return redirect('/reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = $this->report->find($id);
        if(Auth::user()->role_id > 2 && Auth::user()->id != $report->user_id ) {
            $this->report->find($id)->update(['viewed' => 1, 'viewed_at' => date('Y-m-d H:i:s')]);
        }
        
        return view('reports.view', [
            'report' => $this->report->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('reports.edit', [
            'report' => $this->report->find($id)
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
        $input = $request->all();

        $this->report->find($id)->update($input);
        Session::flash('flash_message', 'Information updated ok!');
        return redirect()->route('reports.index');
    }
}
