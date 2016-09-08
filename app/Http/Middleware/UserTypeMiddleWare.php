<?php

namespace App\Http\Middleware;

use Closure;

class UserTypeMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$objectToAccess)
    {
        $usertype = $request->user()->userType->type;
        if($objectToAccess == 'users' || $objectToAccess == 'branch' || $objectToAccess == 'employee'){
            if($usertype === 'Administrator' || 
                ($request->user()->branch_id != NULL&&$request->user()->branchInfo->main_office)){
                return $next($request);
            }
        }
        return view('errors.503');
    }
}
