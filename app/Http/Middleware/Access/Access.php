<?php

namespace App\Http\Middleware\Access;

/**
 * Generates default access check: if logged in user can alter table row
 *
 * @author vsmeu
 */
class Access
{
    protected function getRequestId($request)
    {
        $requestParameters = $request->route()->parameters();
        if(empty($requestParameters)) {
            return false;
        }
        
        $table = key($requestParameters);
        $id = $requestParameters[$table];
        
        return $id;
    }
}
