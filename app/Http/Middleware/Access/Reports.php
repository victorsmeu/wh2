<?php
namespace App\Http\Middleware\Access;

use Closure, DB;

class Reports extends Access
{
    protected $model = 'Report';
    
    public function handle($request, Closure $next, $guard = null)
    {
        $report_id = $this->getRequestId($request);
        
        if($report_id && \Auth::user()->role_id > 2 && 
                (\App\Report::where('id', $report_id)
                            ->where('user_id', \Auth::user()->id)->count() == 0 &&
                \App\Report::whereHas('study', function ($query) use($report_id) {
                    $query->where('reports.id', $report_id);
                    $query->where('user_id', \Auth::user()->id);
                })->count() == 0
                )) {
            return redirect()->back();
        }
        return $next($request);
    }
}
