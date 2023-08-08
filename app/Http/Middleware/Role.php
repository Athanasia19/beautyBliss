<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\Debugbar\Facade as DebugBar;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$role): Response
    {
        if (!Auth::user())
            return redirect('/user/signin');

        // if (AUth::user()->roles === $role){
        //     return $next($request);
        // }


        DebugBar::info($role);
        // DebugBar::info(get_class($next));
        foreach ($role as $role) {
            if (Auth::user()->role === $role) {
                return $next($request);
            }
        }
        return redirect()->back();
    }
}