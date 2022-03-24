<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->mobile_number != null)
            if (auth()->user()->profile_complete == 0 && auth()->user()->is_pilot == 0) {
                return redirect()->route('first-login-edit-user')->with('error', [
                    'title' => 'Access Denied',
                    'content' => 'Please Complete your profile before you can access to other services.'
                ]);
            } elseif (auth()->user()->profile_complete == 1 && auth()->user()->is_pilot == 0) {
                return redirect()->route('first-login-create-operator');
            } else {
                return $next($request);
            }
        return redirect()->route('first-login-edit-user');
    }
}
