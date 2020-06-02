<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if (Auth::guard($guard)->check()) {
            
            if($request->user()->status !=1 ){
                return $next($request);
            }else{

                if ($request->user()->role == 1 || $request->user()->role == 0) 
                {
                    return redirect('/admin/dashboard');
                } 
                else if ($request->user()->role == 3) 
                {
                    return redirect()->route('registrar.dashboard');
                }
                else if ($request->user()->role == 4) 
                {
                    return redirect()->route('faculty.dashboard');
                }
                else if ($request->user()->role == 5) 
                {
                    return redirect()->route('student.dashboard');
                }
                else if ($request->user()->role == 6) 
                {
                    return redirect()->route('finance.dashboard');
                }
                else if ($request->user()->role == 7) 
                {
                    return redirect()->route('admission.dashboard');
                }
            }
        }

        return $next($request);
    }
}
