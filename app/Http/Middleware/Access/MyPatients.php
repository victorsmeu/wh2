<?php
namespace App\Http\Middleware\Access;

use Closure;
use DB;

class MyPatients extends Access
{
    protected $model = 'Patient';
    
    public function handle($request, Closure $next, $guard = null)
    {
        $id = $this->getRequestId($request);

        if ($id && \Auth::user()->role_id > 2 &&
                \App\Patient::where('id', $id)->where('user_id', \Auth::user()->id)->count() == 0) {
            return redirect()->back();
        }
        
        return $next($request);
    }
}
