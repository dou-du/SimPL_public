<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class onlyEditor
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
		if(Auth::user() !== null && (Auth::user()->policy === "editor" || Auth::user()->policy === "admin")){
			return $next($request);
		}else{
			return redirect('/');
		}
    }
}
