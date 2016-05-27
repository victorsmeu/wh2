<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        $requestParameters = $request->route()->parameters();
//        $table = key($requestParameters);
//        $id = $requestParameters[$table];
//        $user_id = \Auth::user()->id;
//        
//        if(\Auth::user()->role_id > 2 && \App\Patient::where('id', $id)->where('user_id', \Auth::user()->id)->count() == 0) {
//            return redirect()->route('patients.index');
//        }
        
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
