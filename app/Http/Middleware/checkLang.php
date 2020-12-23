<?php

namespace App\Http\Middleware;

use App;
use Config;
use Closure;
use Session;
use Illuminate\Http\Request;

class checkLang
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
        if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
            App::setLocale($locale);
        }
        return $next($request);
    }
}
