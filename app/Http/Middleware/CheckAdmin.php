<?php

namespace App\Http\Middleware;

use App\Exceptions\Handler;
use Closure;
use Session;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::get('userlevel') !== 'ACPADMIN'){           
            // return response()->view('messages.notauthorize');
            return abort(403);     
        } 
        return $next($request);
    }
}
