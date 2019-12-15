<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;

class LoginCheck
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
        if ($user = Sentinel::forceCheck())
        {
            return $next($request);
            // User is logged in and assigned to the `$user` variable.
        }
        else
        {
            return \redirect('/login')->with('good','Похоже что вы не вошли в аккаунт!');
            // User is not logged in
        }
    }
}
