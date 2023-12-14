<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeactivatedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->status ==0) {
            Auth::guard('web')->logout(); // Use the appropriate guard ('web', 'api', etc.)
            return response()->json(['message' => 'Your account has been deactivated.'], 401);
        }

        return $next($request);
    }
}
