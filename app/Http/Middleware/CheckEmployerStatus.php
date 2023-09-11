<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmployerStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @param  string  $guard
     */
    public function handle(Request $request, Closure $next,$guard = 'employer')
    {
        
        $employer = Auth::guard($guard)->user();
        
        if (Auth::guard($guard)->check()) {
            if ($employer && $employer->status == 0) {
                // Employer is inactive, redirect to the billing page
                return redirect()->route('employer.list_invoice');
            }
           
            
        }

       
       
        return $next($request);
    }
}
