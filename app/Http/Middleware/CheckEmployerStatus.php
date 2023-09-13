<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

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
                $invoice = Invoice::where('employer_id',$employer->id)->where('status',2)->orderby('created_at','desc')->first();
                return redirect()->route('employer.list_invoice',$invoice->id);
            }
           
            
        }

       
       
        return $next($request);
    }
}
