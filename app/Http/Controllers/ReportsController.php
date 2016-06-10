<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Report;
use App\History;
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
    public function create($patient_id, $study_id)
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
    public function store(Request $request, History $history)
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
        
        $report = $this->report->create($input);
        
        if($active == 1) {        
            $history::create([
                'user_id' => $report->study->user_id,
                'action' => 'New report added',
                'data' => 'A new report was added for patient: ' . $report->study->patient->first_name . ' ' . $report->study->patient->last_name
            ]);
        }
        
        return redirect('/reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, History $history)
    {
        $oldReportData = $this->report->find($id);
        
        if(Auth::user()->role_id > 2 && Auth::user()->id != $oldReportData->user_id ) {
            $this->report->find($id)->update(['viewed' => 1, 'viewed_at' => date('Y-m-d H:i:s')]);
            
            if($oldReportData->viewed == 0) {
                $history::create([
                    'user_id' => $oldReportData->user_id,
                    'action' => 'Report viewed',
                    'data' => 'Report for patient: ' . $oldReportData->study->patient->first_name . ' ' . $oldReportData->study->patient->last_name . ' viewed'
                ]);
            }
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
    public function update(Request $request, $id, History $history)
    {
        $input = $request->all();
        $oldReportData = $this->report->find($id);
        $this->report->find($id)->update($input);
        
        if($oldReportData->active != $input['active']) {
            $status = ($input['active'] == 1) ? 'active' : 'inactive';
            $history::create([
                'user_id' => $oldReportData->study->user_id,
                'action' => 'Report marked as ' . $status,
                'data' => 'Report id #' . $id . ' has been marked as  ' . $status
            ]);
        }
        
        Session::flash('flash_message', 'Information updated ok!');
        return redirect()->route('reports.index');
    }
}
