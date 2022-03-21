<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

            if ($user->hasRole('SuperAdmin')) {
                return redirect('/super');
            } elseif ($user->hasRole('Facility Admin')) {
                return redirect('/facility');
            } elseif ($user->hasRole('Company Admin')) {
                if ($user->Company){
                    return redirect(route('company.dashboard',$user->Company->id));
                }
                return redirect('/company');
            }

        return redirect('/employee');
    }
}
