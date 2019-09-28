<?php

namespace App\Http\Middleware;

use Closure;

class GroupMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$groups)
    {
        if (!empty($request->user())) {
            if ($request->user()->authorizeGroups($groups)) {
                return $next($request);
            }
            abort(403, 'Unauthorized action.');
        }
        return redirect('login');
    }
}
