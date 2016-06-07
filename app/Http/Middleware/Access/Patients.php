<?php
namespace App\Http\Middleware\Access;

use Closure;
use DB;

class Patients extends Access
{
    protected $model = 'Patient';
    
    public function handle($request, Closure $next, $guard = null)
    {
        $id = $this->getRequestId($request);

        if ($id && \Auth::user()->role_id > 2 &&
                (
                DB::table('patients')
                         ->leftJoin('studies', 'studies.patient_id', '=', 'patients.id')
                         ->leftJoin('studies_users', 'studies_users.study_id', '=', 'studies.id')
                         ->where(function ($query) {
                            $query->where('patients.user_id', \Auth::user()->id)
                                  ->orWhere('studies_users.user_id', \Auth::user()->id);
                         })
                         ->where('patients.id', $id)
                         ->count() == 0
                )) {
            return redirect()->back();
        }
        
        return $next($request);
    }
}
