<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        session()->flash('dashboard',1);

        if(Auth::guard()->check() === false){
            return redirect('/login');
        }

        else if(Auth::user()->hasVerifiedEmail() == false) {
            return redirect('/email/verify');
        }

        else if (Auth::user()->role != "admin" && Auth::user()->role != "super_admin"){
            return redirect('/');
        }

        else if (Auth::user()->manage_status == 0){
            return redirect('/');
        }
        return $next($request);
    }
}
