<?php
namespace App\Http\Middleware\Access;

use Closure;

class Users extends Access
{
    protected $model = 'User';
    
    public function handle($request, Closure $next, $guard = null)
    {
        $id = $this->getRequestId($request);

        if(isset($id) && \Auth::user()->role_id > 2 && \Auth::user()->id != $id) {
            return redirect()->back();
        }
        
        return $next($request);
    }
}
