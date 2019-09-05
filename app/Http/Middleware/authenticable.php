<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class authenticable
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
        if(!(Auth::check()||Auth::guard('professor')->check()||Auth::guard('assistant')->check()||Auth::guard('admin')->check()))  return redirect('/login');
        return $next($request);
    }
}
