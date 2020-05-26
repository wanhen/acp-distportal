<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckLogin
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
        if(!Session::get('islogin')){           
            //return response()->view('auth.login');
            return redirect('login');        
        } 
        return $next($request);
    }
}
