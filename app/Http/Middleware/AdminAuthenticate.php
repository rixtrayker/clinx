<?php

namespace App\Http\Middleware;

use Closure;
use App\Libs\Adminauth;

class AdminAuthenticate
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
        if (Adminauth::guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('admin/login');
            }
        }
        return $next($request);
    }
}
