<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsPilot
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
        if (auth()->user()->is_pilot == 0) {
            return redirect()->route('first-login-create-operator')->with('error', [
                'title' => 'Access Denied',
                'content' => 'Please Complete your profile before you can access to other services.'
            ]);
        } else {
            return redirect()->route('dashboard');
        }
    }
}
