<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class IsVerified
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
        if(!auth()->user()->verified){
            Session::flush();
            //Bahasa
            return redirect('login')->withAlert('Harap verifikasi email anda sebelum login');

            //language
            //return redirect('login')->withAlert('Please verify your email before login.');
        }
        return $next($request);
    }
}
